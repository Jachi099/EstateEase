<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('add_service_provider_admins', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('service_type');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('service_area');
            $table->string('experience');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('add_service_provider_admins');
    }
};
