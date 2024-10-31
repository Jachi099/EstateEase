<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';

    protected $primaryKey = 'property_ID';

    protected $fillable = [
        'st_no', 'city', 'state', 'country', 'type', 'size',
        'amenities', 'num_of_rooms', 'num_of_bathrooms', 'rent',
        'img1', 'img2', 'img3', 'status', 'landlord_id', 'floor', 'available_from'
    ];
}
