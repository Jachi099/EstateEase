<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $table = 'service_providers';

    // Specify the columns that can be mass-assigned
    protected $fillable = [
        'name', 'phone', 'service',
    ];
}
