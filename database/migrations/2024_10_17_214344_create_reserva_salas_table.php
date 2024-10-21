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
        Schema::create('reserva_salas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_sala');
            $table->dateTime('dt_hr_inicio');
            $table->dateTime('dt_hr_termino');
            $table->string('nome_responsavel');
            $table->string('status')->default('ativa'); // Coluna para status
            // $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_salas');
    }
};
