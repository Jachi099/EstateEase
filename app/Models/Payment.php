<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'payments';

    // Disable Laravel's default timestamp columns if you're not using them
    public $timestamps = false;  // Only if you don't want created_at/updated_at columns, otherwise remove this line

    // The fields that are mass assignable
    protected $fillable = [
        'visitor_id', 'payment_date', 'amount', 'service_charge', 'status', 'payment_method'
    ];

    // Define the relationship back to Visitor (not Tenant anymore)
    public function visitor()
    {
        return $this->belongsTo(User::class, 'visitor_id');  // Assuming `User` is the model for visitors
    }

    // Optionally, define an accessor for formatted amount if needed
    public function getFormattedAmountAttribute()
    {
        return '৳' . number_format($this->amount, 2);  // For example, formatted as Bangladeshi currency
    }

    // Optionally, define an accessor for service charge if needed
    public function getFormattedServiceChargeAttribute()
    {
        return '৳' . number_format($this->service_charge, 2);
    }
}
