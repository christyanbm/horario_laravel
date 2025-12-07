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
    Schema::create('evaluaciones', function (Blueprint $table) {
    $table->id();
    $table->foreignId('alumno_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('maestro_id')->constrained('users')->onDelete('cascade');
    $table->integer('puntualidad');       // 1-5
    $table->integer('claridad');          // 1-5
    $table->integer('conocimiento');      // 1-5
    $table->integer('dinamica');          // 1-5
    $table->text('comentarios')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
