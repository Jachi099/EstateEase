<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAddAdmin extends Model
{
    use HasFactory;

    protected $table = 'serviceaddadmin';

    protected $fillable = [
        'service_type',
        'details',
        'image_path',
    ];
}