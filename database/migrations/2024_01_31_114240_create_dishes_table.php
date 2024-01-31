<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->nullable();
            $table->string('image')->nullable();
            $table->integer('price')->nullable();
            $table->integer('equipment_id')->nullable();
            $table->string('unit')->nullable();
            $table->string('desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->foreignId('subcategory_id');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
