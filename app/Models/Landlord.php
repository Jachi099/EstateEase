<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Allows it to be authenticated
use Illuminate\Database\Eloquent\Model;


class Landlord extends Authenticatable
{
   
        use HasFactory;
    
        protected $table = 'landlord';
    
        protected $primaryKey = 'landlord_id';
    
        protected $fillable = [
            'name', 'email', 'phone', 'password', 'picture', 'account_type'
        ];
    
    
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

}
