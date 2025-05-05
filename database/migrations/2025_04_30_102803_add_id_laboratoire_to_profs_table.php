<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('profs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_laboratoire')->nullable()->after('id');

            // إذا أردت إضافة مفتاح خارجي:
            $table->foreign('id_laboratoire')->references('id')->on('laboratoires')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('profs', function (Blueprint $table) {
            $table->dropColumn('id_laboratoire');
        });
    }

};
