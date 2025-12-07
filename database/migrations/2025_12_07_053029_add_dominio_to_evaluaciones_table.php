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
         Schema::table('evaluaciones', function (Blueprint $table) {
        $table->integer('dominio')->after('claridad'); // o decimal/string según necesites
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluaciones', function (Blueprint $table) {
        $table->dropColumn('dominio');
    });
    }
};
