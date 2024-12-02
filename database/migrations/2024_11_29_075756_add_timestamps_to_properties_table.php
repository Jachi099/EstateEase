<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }
    
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropTimestamps(); // Drops the created_at and updated_at columns
        });
    }
    
};