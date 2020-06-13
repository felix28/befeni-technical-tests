<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShirtOrder extends Model
{
    protected $fillable = [
        'customer_id', 
        'fabric_id',
        'collar_size', 
        'chest_size', 
        'waist_size', 
        'wrist_size'
    ];
}
