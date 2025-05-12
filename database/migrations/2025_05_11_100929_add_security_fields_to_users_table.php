<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('login_attempts')->default(0)->after('last_login');
            $table->timestamp('locked_until')->nullable()->after('login_attempts');
            $table->string('last_login_ip')->nullable()->after('locked_until');
            $table->text('last_login_user_agent')->nullable()->after('last_login_ip');
            $table->boolean('is_active')->default(true)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'login_attempts',
                'locked_until',
                'last_login_ip',
                'last_login_user_agent',
                'is_active'
            ]);
        });
    }
};
