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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('amount');
            $table->string('name', 250)->nullable();
            $table->text('description')->nullable();
            $table->text('imageUrl')->nullable();
            $table->boolean('isdeleted')->default(0);
            $table->timestamp('deleteat')->nullable();
            $table->integer('createdby')->nullable();
            $table->timestamps();
            $table->integer('updatedby')->nullable();
            $table->timestamp('updatedat')->nullable();
            $table->integer('itemcategoryid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
