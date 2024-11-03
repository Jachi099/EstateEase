<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitRequest extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'visit_date',
        'visit_time',
        'status',
    ];
}
