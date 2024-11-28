<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';
    protected $primaryKey = 'property_ID';

    public $timestamps = false;

    protected $fillable = [
        'house_no', 'area', 'thana', 'city', 'type', 'size',
        'amenities', 'num_of_rooms', 'num_of_bathrooms', 'rent',
        'img1', 'img2', 'img3', 'status', 'landlord_id', 'floor', 'available_from', 'num_of_balcony'
    ];
    

    // Relationship to the Landlord model
    public function landlord()
    {
        return $this->belongsTo(Landlord::class, 'landlord_id');
    }
}
