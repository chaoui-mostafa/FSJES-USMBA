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
        Schema::create('profs', function (Blueprint $table) {
            $table->id('id_prof');
            $table->foreignId('user_id')->constrained();
            $table->string('nom');
            $table->string('nom_ar');
            $table->string('grade', 100);
            $table->string('etablissement');
            $table->string('departement');
            $table->string('type', 100);
            $table->enum('sexe', ['M','F']);
            $table->foreignId('id_laboratoire')->constrained('laboratoires');

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
