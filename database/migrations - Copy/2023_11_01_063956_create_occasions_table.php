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
        Schema::create('occasions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes(); // Implementing soft delete
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('occasions');
    }
};
