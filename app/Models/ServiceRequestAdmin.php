<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestAdmin extends Model
{
    use HasFactory;

    protected $table = 'service_requests';

    protected $fillable = [
        'service_type',
        'description',
        'status',
    ];
}
