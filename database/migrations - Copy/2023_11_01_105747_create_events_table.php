<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guests');
            $table->string('type'); // Dropdown with option for a text box
            $table->date('date');
            $table->string('occasion'); // Dropdown with option for a text box
            $table->string('start_time');
            $table->string('end_time'); 
             $table->string('location')->nullable(); // New field for 'Pick up'
            $table->string('address')->nullable(); // New field for 'Drop-off'
            $table->string('otherType')->nullable(); // Retaining 'Other' type field
          
            $table->softDeletes(); // Implementing soft delete
            $table->timestamps();  
            $table->unsignedBigInteger('createdby')->nullable(); // Foreign key to User
            
            $table->foreign('createdby')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
