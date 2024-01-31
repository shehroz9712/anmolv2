<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_venues', function (Blueprint $table) {
            $table->id();
            $table->string('ContactPerson');
            $table->string('ContactEmail')->nullable();
            $table->string('event_id')->nullable();
            $table->string('ContactPhone');
            $table->unsignedBigInteger('admin_venue_id')->nullable(); // Foreign key to AdminVenue
            $table->unsignedBigInteger('createdby')->nullable(); // Foreign key to User
            $table->softDeletes(); // Soft delete column
            $table->timestamps();
    
            $table->foreign('admin_venue_id')->references('id')->on('admin_venues');
            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('createdby')->references('id')->on('users');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_venues');
    }
};
