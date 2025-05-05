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
        Schema::table('doctorants', function (Blueprint $table) {
            $table->unsignedBigInteger('id_prof')->nullable()->after('id');
            // إذا كنت تربطه بجدول الأساتذة:
            $table->foreign('id_prof')->references('id')->on('profs')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctorants', function (Blueprint $table) {
            //
        });
    }
};
