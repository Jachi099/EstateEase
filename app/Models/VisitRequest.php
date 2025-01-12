<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class VisitRequest extends Model
{
    protected $casts = [
        'visit_date' => 'date', // This will automatically cast 'visit_date' to a Carbon instance
    ];

    protected $fillable = [
        'user_id',
        'property_id',
        'visit_date',
        'visit_time',
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
