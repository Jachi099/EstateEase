<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $table = 'property_images'; // Table name
    protected $fillable = ['property_ID', 'image_path'];

    // Disable automatic timestamps if not used in the table
    public $timestamps = false;


    // Relationship to the Property model
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_ID');
    }
}
