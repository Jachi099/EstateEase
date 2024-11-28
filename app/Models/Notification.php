<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications'; // Ensure this matches the table name
     
    protected $fillable = [
        'landlord_id',
        'message',
        'status',
    ];

    public $timestamps = true; // Ensure timestamps are managed automatically
}

