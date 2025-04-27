<?php

namespace Database\Seeders;

use App\Models\Doctorant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DoctorantSeeder extends Seeder
{
    public function run(): void
{
    \App\Models\Doctorant::factory(10000)->create();


}

}
