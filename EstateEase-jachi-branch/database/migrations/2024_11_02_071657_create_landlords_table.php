<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordsTable extends Migration
{
    public function up()
    {
        Schema::create('landlord', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('picture');
            $table->string('account_type');
            $table->string('current_address'); // Add this field if you want to store the address
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('landlord');
    }
}
