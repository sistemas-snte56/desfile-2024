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
        Schema::create('teacher', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_delegacion')->nullable();
            $table->string('nombre', 250)->nullable();
            $table->string('apaterno', 250)->nullable();
            $table->string('amaterno', 250)->nullable();
            $table->string('npersonal', 250)->nullable();
            $table->string('rfc', 250)->nullable();
            $table->string('genero', 250)->nullable();
            $table->string('telefono', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('folio', 250)->nullable();
            $table->string('codigo_id', 250)->nullable();
            $table->string('codigo_qr')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_delegacion')->references('id')->on('delegations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher');
    }
};
