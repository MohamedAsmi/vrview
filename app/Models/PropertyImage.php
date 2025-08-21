<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'image_path',
        'image_title',
        'pitch',
        'yaw',
        'hfov',
        'order_id', 
        'status',
    ];
}
