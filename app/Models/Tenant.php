<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tenants';
    protected $primaryKey = 'id';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'current_address',
        'phone_number',
        'account_type',
        'picture',
        'property_ID',
        'rental_start_date',
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

    // Define relationship to Payments
    public function payments()
    {
        return $this->hasMany(Payment::class, 'tenant_id');
    }
}
