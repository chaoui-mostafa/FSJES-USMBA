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
        Schema::create('doctorants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('cne', 50)->unique();
            $table->string('cin', 50)->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('nom_ar');
            $table->string('prenom_ar');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('nationalite', 100);
            $table->enum('sexe', ['M','F']);
            $table->boolean('fonctionnaire');
            $table->string('bourse', 100);
            $table->string('formation');
            $table->text('sujet');
            $table->foreignId('id_prof')->constrained('profs');
            $table->foreignId('id_laboratoire')->constrained('laboratoires');
            $table->date('date_soutenance')->nullable();
            $table->string('situation', 100);
            $table->string('these');
            $table->string('mention', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctorants');
    }
};
