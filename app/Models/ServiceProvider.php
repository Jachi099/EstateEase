<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $table = 'service_providers';

    // Specify the columns that can be mass-assigned
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'specialization',
        'availability_status',
        'picture', // Make sure 'picture' is included
    ];


    // Relationship: A ServiceProvider offers many Services
    public function services()
    {
        return $this->hasMany(Service::class, 'service_provider_id');
    }

    // Relationship: A ServiceProvider has many ServiceRequests
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'service_provider_id');
    }
}



