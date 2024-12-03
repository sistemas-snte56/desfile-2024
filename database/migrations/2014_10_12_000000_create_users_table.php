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
        /*
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();
                $table->timestamps();
            });
        */

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_delegacion');
            $table->unsignedBigInteger('id_genero');
            $table->string('cargo');
            $table->string('nombre');
            $table->string('apaterno');
            $table->string('amaterno')->nullable();;
            $table->string('email')->unique();
            $table->boolean('status_lista')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->foreign('id_genero')->references('id')->on('genres');
            $table->foreign('id_delegacion')->references('id')->on('delegations');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
