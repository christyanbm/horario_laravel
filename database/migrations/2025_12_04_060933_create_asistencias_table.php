<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::create('asistencias', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('grupo_id');
    $table->unsignedBigInteger('materia_id');
    $table->unsignedBigInteger('maestro_id');
    $table->unsignedBigInteger('alumno_id');

    $table->date('fecha');
    $table->time('hora')->nullable();

    $table->enum('estado', ['presente', 'ausente', 'justificado']);
    $table->text('observacion')->nullable();

    $table->timestamps();
});

}

    

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
