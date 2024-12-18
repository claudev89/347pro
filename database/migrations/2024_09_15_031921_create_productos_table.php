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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 64)->unique();
            $table->string('slug', 80);
            $table->unsignedMediumInteger('precio');
            $table->unsignedSmallInteger('cantidad');
            $table->unsignedBigInteger('marca_id');
            $table->string('descripcion_corta');
            $table->longText('descripcion_larga')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            $table->foreign('marca_id')->references('id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
