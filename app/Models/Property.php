<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'address',
        'address2',
        'room_count',
        'bath_count',
        'status',
    ];

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }
}
