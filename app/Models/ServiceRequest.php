<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $table = 'service_requests';

    protected $fillable = [
        'tenant_id',
        'property_ID',
        'service_id',
        'service_provider_id',
        'status',
        'requested_date',
        'total_cost',
        'labor_cost',
        'urgency_fee',
        'platform_fee',
        'description',
    ];

    /**
     * Define the relationship to the Tenant model.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Define the relationship to the Property model.
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_ID', 'id');
    }

    /**
     * Define the relationship to the Service model.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    /**
     * Define the relationship to the Service Provider model.
     */
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id', 'id');
    }
}
