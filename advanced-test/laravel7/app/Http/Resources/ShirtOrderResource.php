<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShirtOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'customer_id' => $this->customer_id, 
            'fabric_id'   => $this->fabric_id,
            'collar_size' => $this->collar_size, 
            'chest_size'  => $this->chest_size, 
            'waist_size'  => $this->waist_size, 
            'wrist_size'  => $this->wrist_size
        ];
    }
}
