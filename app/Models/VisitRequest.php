<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitRequest extends Model
{
    protected $fillable = [
        'user_id',
        'user_phn',
        'visit_date',
        'visit_time',
        'property_id',
        'status',
    ];

    public function visitor()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust if the visitor model is different
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
