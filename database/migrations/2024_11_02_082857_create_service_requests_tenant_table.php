<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests_tenant', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');
            $table->text('problem_details');
            $table->unsignedBigInteger('property_id'); // Foreign key to properties table
            $table->dateTime('preferred_date');
            $table->string('urgency');
            $table->timestamps();

            // Optional: Foreign key constraint if 'properties' table exists
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_requests_tenant');
    }
}
