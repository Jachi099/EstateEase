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
            'service_type',
            'service_date',
            'service_time',
            'description',
            'status',
        ];
    
        // Define the relationship to the Tenant model
        public function tenant()
        {
            return $this->belongsTo(Tenant::class);
        }
    
        // Define the relationship to the Property model
        public function property()
        {
            return $this->belongsTo(Property::class, 'property_ID', 'property_ID');
        }
    }
    

