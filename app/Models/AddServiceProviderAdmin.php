<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddServiceProviderAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 
        'service_type', 
        'email', 
        'phone_number', 
        'service_area', 
        'experience', 
        'profile_picture',
    ];

    protected $table = 'add_service_provider_admins';
}
