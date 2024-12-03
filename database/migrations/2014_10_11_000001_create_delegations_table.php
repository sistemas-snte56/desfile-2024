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
        Schema::create('delegations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_region');
            // $table->unsignedBigInteger('id_user');
            $table->string('delegacion', 150);
            $table->string('nivel_delegaciona', 250);
            $table->string('sede_delegaciona', 250);
            $table->foreign('id_region')->references('id')->on('regions');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegations');
    }
};
