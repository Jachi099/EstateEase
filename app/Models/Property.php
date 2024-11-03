<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;


    protected $table = 'property';
    protected $primaryKey = 'property_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'st_no',
        'city',
        'state',
        'country',
        'type',
        'size',
        'amenities',
        'num_of_rooms',
        'num_of_bathrooms',
        'rent',
        'img1',
        'img2',
        'img3',
        'status', // e.g., "available", "rented", etc.
        'landlord_id',
        'floor',
        'available_from',
    ];


    // Assuming each property can have multiple visit requests
    public function visitRequests()
    {
        return $this->hasMany(VisitRequest::class, 'property_id'); // Match foreign key in VisitRequest
    }
   
}
