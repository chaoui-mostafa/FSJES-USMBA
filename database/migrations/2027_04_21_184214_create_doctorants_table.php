<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('doctorants', function (Blueprint $table) {
            $table->id();
            $table->string('nomar')->nullable();
            $table->string('prenomar')->nullable();
            $table->date('datenaissance')->nullable();
            $table->string('lieunaissance')->nullable();
            $table->string('lieunaissancear')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('sexe')->nullable();
            $table->string('image')->nullable();
            $table->string('fonctionnaire')->nullable();
            $table->string('bourse')->nullable();
            $table->string('promo')->nullable();
            $table->string('formation')->nullable();
            $table->string('laboratoire')->nullable();
            $table->text('sujet')->nullable();
            $table->string('encadrant')->nullable();
            $table->string('coencadrant')->nullable();
            $table->date('datesoutenance')->nullable();
            $table->string('anneesoutenance')->nullable();
            $table->text('remarque')->nullable();
            $table->string('situation')->nullable();
            $table->string('these')->nullable();
            $table->string('rapporteur1')->nullable();
            $table->string('etatrapporteur1')->nullable();
            $table->date('datedepotrapport1')->nullable();
            $table->string('rapporteur2')->nullable();
            $table->string('etatrapporteur2')->nullable();
            $table->date('datedepotrapport2')->nullable();
            $table->string('rapporteur3')->nullable();
            $table->string('etatrapporteur3')->nullable();
            $table->date('datedepotrapport3')->nullable();
            for ($i = 1; $i <= 7; $i++) {
                $table->string("jury$i")->nullable();
                $table->string("grade$i")->nullable();
                $table->string("status$i")->nullable();
            }
            $table->string('mentionfr')->nullable();
            $table->string('mentionar')->nullable();
            // $table->string('password')->nullable();
            // $table->text('token')->nullable();
            // $table->timestamp('last_login')->nullable();
            // $table->timestamp('last_logout')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('doctorants');
    }
};
