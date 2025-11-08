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
        'user_id',
        'image_title',
        'pitch',
        'yaw',
        'hfov',
        'order_id', 
        'status',
    ];

    public function hostpot()
    {
        return $this->hasMany(Hotspot::class, 'property_image_id');
    }
}
