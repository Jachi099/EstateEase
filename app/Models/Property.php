<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';
    protected $primaryKey = 'property_ID';

    public $timestamps = false; // Disable automatic timestamps

    protected $fillable = [
        'house_no',
        'area',
        'thana',
        'city',
        'postal_code', // Add postal_code
        'type',
        'size',
        'amenities',
        'num_of_rooms',
        'num_of_bathrooms',
        'rent',
        'status',
        'landlord_id',
        'floor',
        'available_from',
        'num_of_balcony',
    ];

    // Relationship to the Landlord model
    public function landlord()
    {
        return $this->belongsTo(Landlord::class, 'landlord_id');
    }
    public function propertyImages()
{
    return $this->hasMany(PropertyImage::class, 'property_ID', 'property_ID');
}


// In Property.php model

public function visitRequests()
{
    return $this->hasMany(VisitRequest::class, 'property_id', 'property_ID');
}


    // Relationship to the PropertyImage model
    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_ID');
    }

public function tenants()
{
    return $this->hasMany(Tenant::class, 'property_ID');
}

// Property Model (App\Models\Property)

public function tenantPayments()
{
    return $this->hasManyThrough(
        TenantPayment::class,  // The related model
        Tenant::class,         // The intermediate model (tenant)
        'property_ID',         // Foreign key on the tenant table
        'tenant_id',           // Foreign key on the tenant_payment table
        'id',                   // Local key on the property table
        'id'                    // Local key on the tenant table
    );
}


}
