<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
    protected $table = 'landlord'; // Specify the table if it's not 'admins'

    // Specify fillable fields
    protected $fillable = ['Name', 'Email', 'password'];

    // Specify hidden fields
    protected $hidden = ['password', 'remember_token'];
}
