<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestTenant extends Model
{
    use HasFactory;

    protected $table = 'service_requests_tenant'; // Explicitly specify the table name

    protected $fillable = [
        'service_type',
        'problem_details',
        'property_id',
        'preferred_date',
        'urgency',
    ];

    // Define relationship to Property model (if exists)
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

