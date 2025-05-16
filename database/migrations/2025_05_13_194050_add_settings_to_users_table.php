<?php
// database/migrations/xxxx_xx_xx_add_settings_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('dark_mode')->default(false);
            $table->boolean('receive_notifications')->default(true);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dark_mode', 'receive_notifications']);
        });
    }
}
