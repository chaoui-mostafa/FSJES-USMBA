<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مستخدم مسؤول (Admin)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // تحقق من البريد الإلكتروني لتجنب التكرار
            [
                'name' => 'Admin User',
                'email_verified_at' => now(),
                'password' => Hash::make('admin2025'), // كلمة مرور مشفرة
                'remember_token' => Str::random(length: 10),
            ]
        );

        // إنشاء مستخدمين إضافيين (اختياري)
        User::factory(1)->create();
    }
}
