<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('NUMERO')->nullable();
            $table->string('CNE')->nullable();
            $table->string('CIN')->nullable();
            $table->string('NOM')->nullable();
            $table->string('PRENOM')->nullable();
            $table->date('DATE_NAISSANCE')->nullable();
            $table->string('NATIONALITE')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('TELEPHONE')->nullable();
            $table->string('SPECIALITE')->nullable();
            $table->text('SUJET')->nullable();
            $table->string('ENCADREUR_1')->nullable();
            $table->string('ENCADREUR_2')->nullable();
            $table->string('PRESIDENT')->nullable();
            $table->string('RAPPORTEUR_INT')->nullable();
            $table->string('RAPPORTEUR_EXT')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
