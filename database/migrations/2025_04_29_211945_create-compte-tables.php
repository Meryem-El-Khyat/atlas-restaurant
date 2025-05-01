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
        Schema::create('compte', function (Blueprint $table) {
            $table->string('Matricule')->primary();
            $table->string('login')->unique();
            $table->string('motdepasse');
            $table->string('nom');
            $table->string('Prenom');
            $table->string('Email')->unique();
            $table->string('photo')->nullable();
            $table->enum('TypeCompte', ['admin', 'personnel']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compte');
    }
};
