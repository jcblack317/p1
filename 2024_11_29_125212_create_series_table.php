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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo', 50);
            $table->string('titulo_original', 50);
            $table->year('año_inicio');
            $table->year('año_fin')->nullable();
            $table->string('estado');
            $table->string('genero');
            $table->text('sinopsis');
            $table->string('clasificacion', 5);
            $table->string('idioma', 50);
            $table->string('pais');
            $table->string('creador');
            $table->string('poster')->nullable();
            $table->integer('temporadas');
            $table->integer('capitulos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};