<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctorants', function (Blueprint $table) {
            $table->id();
            $table->string('NUMERO')->nullable();
            $table->string('CNE')->nullable();
            $table->string('CIN')->nullable();
            $table->string('NOM')->nullable();
            $table->string('NOMAR')->nullable();
            $table->string('PRENOMAR')->nullable();
            // $table->string('LIEUNAISSANCEAR')->nullable();
            $table->string('PRENOM')->nullable();
            $table->date('DATENAISSANCE')->nullable();
            $table->string('LIEUNAISSANCE')->nullable();
            $table->string('LIEUNAISSANCEAR')->nullable();
            $table->string('NATIONALITE')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('TELEPHONE')->nullable();
            $table->string('SEXE')->nullable();
            $table->string('IMAGE')->nullable();
            $table->boolean('FONCTIONNAIRE')->default(false);
            $table->boolean('BOURSE')->default(false);
            $table->string('PROMO')->nullable();
            $table->string('FORMATION')->nullable();
            $table->string('LABORATOIRE')->nullable();
            $table->text('SUJET')->nullable();
            $table->string('ENCADRANT')->nullable();
            $table->string('COENCADRANT')->nullable();
            $table->date('DATESOUTENANCE')->nullable();
            $table->string('ANNEESOUTENANCE')->nullable();
            $table->text('REMARQUE')->nullable();
            $table->string('SITUATION')->nullable();
            $table->string('THESE')->nullable();
            $table->string('RAPPORTEUR1')->nullable();
            $table->string('Etat_Rapporteur1')->nullable();
            $table->date('DateDeDepotRapport1')->nullable();
            $table->string('RAPPORTEUR2')->nullable();
            $table->string('EtatRapporteur2')->nullable();
            $table->date('DateDeDepotRapport2')->nullable();
            $table->string('RAPPORTEUR3')->nullable();
            $table->string('EtatRapporteur3')->nullable();
            $table->date('DateDeDepotRapport3')->nullable();
            $table->string('JURY1')->nullable();
            $table->string('GRADE1')->nullable();
            $table->string('STATUS1')->nullable();
            $table->string('JURY2')->nullable();
            $table->string('GRADE2')->nullable();
            $table->string('STATUS2')->nullable();
            $table->string('JURY3')->nullable();
            $table->string('GRADE3')->nullable();
            $table->string('STATUS3')->nullable();
            $table->string('JURY4')->nullable();
            $table->string('GRADE4')->nullable();
            $table->string('STATUS4')->nullable();

            $table->string('JURY5')->nullable();
            $table->string('GRADE5')->nullable();
            $table->string('STATUS5')->nullable();
            $table->string('JURY6')->nullable();
            $table->string('GRADE6')->nullable();
            $table->string('STATUS6')->nullable();
            $table->string('JURY7')->nullable();
            $table->string('GRADE7')->nullable();
            $table->string('STATUS7')->nullable();
            $table->string('MENTIONFR')->nullable();
            $table->string('MENTIONAR')->nullable();
            



            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctorants');
    }
};
