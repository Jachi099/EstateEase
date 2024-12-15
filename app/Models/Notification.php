<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications'; // Make sure this points to your custom table
    protected $fillable = ['landlord_id', 'message', 'status']; // Fields in your table

    // Optionally, you can define relationships here, e.g., if a notification belongs to a landlord
    public function landlord()
    {
        return $this->belongsTo(Landlord::class, 'landlord_id');
    }
}
