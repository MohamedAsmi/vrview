<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceRecord extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'property_images_id',
        'user_id', 
        'record_method',
        'text_content',
        'file_path',
        'file_name'
    ];

    /**
     * Get the property image that owns the voice record
     */
    public function propertyImage()
    {
        return $this->belongsTo(PropertyImage::class, 'property_images_id');
    }

    /**
     * Get the user that owns the voice record
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
