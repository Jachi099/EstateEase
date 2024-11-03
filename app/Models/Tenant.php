<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $table = 'tenants'; // Make sure this matches your actual table name
    protected $primaryKey = 'id'; // Set this to your primary key field

    // Fillable attributes for mass assignment
    protected $fillable = [
        'full_name',
        'email',
        'password', // If you want to store the password
        'current_address',
        'phone_number',
        'account_type',
        'picture',
        'property_ID', // Add this line for mass assignment
        // Add any other fields relevant to the tenant
    ];
    
    // Define relationship to Property if needed
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_ID', 'property_ID');
    }
}
