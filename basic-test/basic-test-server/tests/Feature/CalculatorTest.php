<?php

namespace Tests\Feature;

use App\Http\Controllers\CalculatorController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CalculatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        //prepare something for each test

        $this->apiURL = 'api/calculate';

        Storage::fake('instructions');
    }

    public function testUploadTxtFileFormat()
    {
        $sizeInKilobytes = 1;
        $file = UploadedFile::fake()->create('test.txt', $sizeInKilobytes, 'text/plain');

        $this->json('POST', $this->apiURL, ['file' => $file]);

        // Assert the file was stored...
        Storage::assertExists('public/instructions/'.$file->hashName());

        Storage::delete($file);
    }

    public function testDontUploadInvalidFileType()
    {
        $sizeInKilobytes = 1;
        $file = UploadedFile::fake()->create('document.pdf', $sizeInKilobytes, 'application/pdf');

        $this->json('POST', $this->apiURL, ['file' => $file])
            ->assertStatus(422);

        // Assert a file does not exist...
        Storage::assertMissing('public/instructions/'.$file->hashName());

        Storage::delete($file);
    }

    public function testReadUploadedFileContents()
    {
        $file = 'public/instructions/test.txt';
        //assume file is already uploaded
        Storage::put($file, 'Hello World');

        Storage::assertExists($file);

        $contents = Storage::get($file);

        $this->assertEquals($contents, 'Hello World');

        Storage::delete($file);
    }

    public function testReadUploadedFileNextLine()
    {
        $file = 'public/instructions/test.txt';
        
        Storage::put($file, 'Prepended Text');
        Storage::append($file, 'Appended Text');

        $lines = file(
            env('APP_URL').'/storage/instructions/test.txt',
            FILE_SKIP_EMPTY_LINES
        );//file in to an array
    
        $this->assertEquals($lines[1], 'Appended Text');

        Storage::delete($file);
    }

    public function testReadUploadedFileNextNextLine()
    {
        $file = 'public/instructions/test.txt';
        
        Storage::put($file, 'Prepended Text');
        Storage::append($file, 'Appended Text');
        Storage::append($file, 'Last Text');

        $lines = file(
            env('APP_URL').'/storage/instructions/test.txt',
            FILE_SKIP_EMPTY_LINES
        );//file in to an array
    
        $this->assertEquals($lines[2], 'Last Text');

        Storage::delete($file);
    }

    public function testGetNumberOfLines()
    {
        $file = 'public/instructions/test.txt';
        
        Storage::put($file, 'Prepended Text');
        Storage::append($file, 'Appended Text');
        Storage::append($file, 'Last Text');

        $lines = file(
            env('APP_URL').'/storage/instructions/test.txt',
            FILE_SKIP_EMPTY_LINES
        );//file in to an array
    
        $this->assertEquals(3, count($lines));

        Storage::delete($file);
    }

    public function testDontCalculateIfNoApplyInLastLine()
    {
        $instructionToFind = "apply ";
        $wrongText = 'Prepended Text';
        $file = 'public/instructions/test.txt';
        Storage::put($file, $wrongText);

        $controller = new CalculatorController;

        $this->assertEquals(false, $controller->calculate($file, 'test'));

        $contents = Storage::get($file);
        $this->assertEquals($contents, $wrongText);

        Storage::delete($file);
    }

    public function testCalculateSingle()
    {
        $file = 'public/instructions/test.txt';
        Storage::put($file, 'apply 1');

        $controller = new CalculatorController;

        $this->assertEquals(1, $controller->calculate($file, 'test'));

        Storage::delete($file);
    }

    public function testCalculateDouble()
    {
        $file = 'public/instructions/test.txt';
        Storage::put($file, 'multiply 9');
        Storage::append($file, 'apply 5');

        $controller = new CalculatorController;

        $this->assertEquals(45, $controller->calculate($file, 'test'));

        Storage::delete($file);
    }

    public function testCalculateMultiple()
    {
        $file = 'public/instructions/test.txt';
        Storage::put($file, 'add 2');
        Storage::append($file, 'multiply 3');
        Storage::append($file, 'apply 3');

        $controller = new CalculatorController;

        $this->assertEquals(15, $controller->calculate($file, 'test'));

        Storage::delete($file);
    }
}
