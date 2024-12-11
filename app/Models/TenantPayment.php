<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantPayment extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'tenant_payments';

    // Set the fillable fields (adjust as per your table structure)
    protected $fillable = [
        'tenant_id',
        'amount',
        'status',
        'payment_date'
    ];

    // Define the relationship with Tenant
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');  // 'tenant_id' is the foreign key
    }
}
