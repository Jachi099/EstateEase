<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $table = 'property_images'; // Adjust if the table name is different
    protected $primaryKey = 'id'; // Adjust if the primary key is different
    public $timestamps = true; // Set to false if the table doesn't have timestamps

    protected $fillable = [
        'property_ID',
        'image_path',
    ];

    // Define relationship with Property model (if applicable)
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_ID', 'property_ID');
    }
}
