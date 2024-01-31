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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->id();
            $table->string('name', 64)->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('category_id');
            $table->tinyInteger('is_addon')->default(0);
            $table->double('single', 6, 2)->nullable();
            $table->double('double', 6, 2)->nullable();
            $table->double('trio', 6, 2)->nullable();
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
