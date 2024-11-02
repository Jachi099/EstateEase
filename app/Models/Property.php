<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function rentals()
{
    return $this->hasMany(Rental::class);
}
}
