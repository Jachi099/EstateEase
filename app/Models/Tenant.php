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
            'full_name', 'email', 'password', 'current_address', 'phone_number', 'account_type',
            'property_ID', 'rental_start_date', 'rent', 'picture'
        ];



    // Disable password hashing logic using an internal flag (without it being a database column)
    private $disablePasswordHashing = false;

    // Accessor to set disablePasswordHashing dynamically (not a database field)
    public function setDisablePasswordHashing($value)
    {
        $this->disablePasswordHashing = $value;
    }

    // Hash the password when creating or updating the tenant
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tenant) {
            // Only hash password if flag is not set
            if (!$tenant->disablePasswordHashing && $tenant->isDirty('password')) {
                $tenant->password = bcrypt($tenant->password);
            }
        });

        static::updating(function ($tenant) {
            // Only hash password if flag is not set
            if (!$tenant->disablePasswordHashing && $tenant->isDirty('password')) {
                $tenant->password = bcrypt($tenant->password);
            }
        });
    }
// In Tenant Model
public function tenantPayments()
{
    return $this->hasMany(TenantPayment::class, 'tenant_id');  // Assuming 'tenant_id' is the foreign key in tenant_payments table
}



    // Define relationship to Property if needed
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_ID', 'property_ID');
    }


}
