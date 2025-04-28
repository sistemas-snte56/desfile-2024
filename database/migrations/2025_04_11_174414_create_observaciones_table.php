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
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id();
        
            // Usuario observado (el que está siendo cotejado)
            $table->foreignId('user_id')->constrained('users');
        
            // Usuario que realiza la observación (quien tiene el rol de Cotejador)
            $table->foreignId('cotejador_id')->constrained('users');
        
            $table->text('mensaje');
            $table->boolean('atendida')->default(false); // admin marcará esto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observaciones');
    }
};
