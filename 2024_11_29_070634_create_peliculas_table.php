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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo', 50);
            $table->string('titulo_original', 50);
            $table->year('año_estreno');
            $table->integer('duracion');
            $table->string('genero');
            $table->text('sinopsis');
            $table->string('clasificacion', 5);
            $table->string('idioma', 50);
            $table->string('poster');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};