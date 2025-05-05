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
        // In the migration file
        Schema::create('profs', function (Blueprint $table) {
                $table->id();
                $table->string('nom_prenom');
                $table->string('nom_prenom_arabe');
                $table->string('email_professionnel')->nullable();
                $table->string('numero_telephone')->nullable();
                $table->string('grade');
                $table->string('grade_ar');
                $table->string('departement');
                $table->string('departement_ar');
                $table->string('etablissement_fr');
                $table->string('etablissement_ar');
                $table->string('type');
                $table->string('sexe');
                $table->string('doc')->nullable();
                $table->string('prof')->nullable();
                $table->string('genre')->nullable();
                $table->string('status_ar');
                $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profs');
    }
};
