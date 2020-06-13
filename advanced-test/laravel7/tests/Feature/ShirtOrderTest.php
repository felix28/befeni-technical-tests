<?php

namespace Tests\Feature;

use App\ShirtOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShirtOrderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiURL = 'api/shirt-orders/';

        $this->jsonStructure = [
                'id', 
                'customer_id', 
                'fabric_id',
                'collar_size', 
                'chest_size', 
                'waist_size', 
                'wrist_size'
        ];
    }

    /** @test */
    public function create()
    {
        $data = [
            'customer_id' => 1, 
            'fabric_id'   => 1,
            'collar_size' => 36, 
            'chest_size'  => 24, 
            'waist_size'  => 36, 
            'wrist_size'  => 69
        ];

        $this->assertEquals(0, ShirtOrder::count());

        $this->json('POST', $this->apiURL, $data)
            ->assertStatus(201)
            ->assertJsonStructure($this->jsonStructure);

        $this->assertEquals(1, ShirtOrder::count());

        $shirtOrder = ShirtOrder::first();

        $this->assertEquals($data['customer_id'], $shirtOrder->customer_id);
        $this->assertEquals($data['collar_size'], $shirtOrder->collar_size);
    }

    public function testShow()
    {
        factory('App\ShirtOrder')->create();
        
        $shirtOrder = ShirtOrder::first();
        
        $this->apiURL = $this->apiURL.$shirtOrder->id; 

        $this->json('GET', $this->apiURL)
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructure);
    }

    public function testDelete()
    {
        factory('App\ShirtOrder')->create();
        
        $this->assertEquals(1, ShirtOrder::count());

        $shirtOrder = ShirtOrder::first();

        $this->deleteJson($this->apiURL.$shirtOrder->id)
            ->assertStatus(204);

        $this->assertEquals(0, ShirtOrder::count());
    }

    public function testPaginate()
    {
        $this->assertEquals(0, ShirtOrder::count());

        factory('App\ShirtOrder', 10)->create();
        
        $this->assertEquals(10, ShirtOrder::count());

        $jsonStructure = [
            'data' => [
                [
                    'id', 
                    'customer_id', 
                    'fabric_id',
                    'collar_size', 
                    'chest_size', 
                    'waist_size', 
                    'wrist_size'
                ]
            ]
        ];

        $this->json('GET', $this->apiURL)
            ->assertStatus(200)
            ->assertJsonStructure($jsonStructure);
    }
}
