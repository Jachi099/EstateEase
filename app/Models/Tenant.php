<?php

namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable; // Update to use Authenticatable
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Authenticatable // Extend Authenticatable for authentication
{
    use HasFactory, Notifiable; // Include Notifiable trait for notifications

    protected $table = 'tenants'; // Make sure this matches your actual table name
    protected $primaryKey = 'id'; // Set this to your primary key field

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'current_address',
        'phone_number',
        'account_type',
        'picture',
        'property_ID',
        'rental_start_date', // Add this line
    ];
    
    // Hash the password when creating or updating the tenant
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tenant) {
            if ($tenant->isDirty('password')) {
                $tenant->password = bcrypt($tenant->password);
            }
        });

        static::updating(function ($tenant) {
            if ($tenant->isDirty('password')) {
                $tenant->password = bcrypt($tenant->password);
            }
        });
    }

    // Define relationship to Property if needed
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_ID', 'property_ID');
    }
}
