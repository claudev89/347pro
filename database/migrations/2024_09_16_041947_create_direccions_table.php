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
        Schema::create('direccions', function (Blueprint $table) {
            $table->id();
            $table->string('calle', 35);
            $table->unsignedMediumInteger('numero')->nullable();
            $table->string('extra', 40)->nullable();
            $table->unsignedBigInteger('comuna_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->foreign('user_id')->references('id')->on('comunas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccions');
    }
};
