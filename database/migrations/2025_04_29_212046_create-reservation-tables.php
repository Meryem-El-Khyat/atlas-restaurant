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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id('ID');
            $table->date('DateReservation');
            $table->boolean('Repas1')->default(false); // Petit-déjeuner
            $table->boolean('Repas2')->default(false); // Déjeuner
            $table->boolean('Repas3')->default(false); // Dîner
            $table->string('Matricule');
            $table->boolean('Annulation')->default(false);
            $table->timestamps();

            $table->foreign('Matricule')->references('Matricule')->on('compte')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
