<?php

namespace Database\Factories;

use App\Models\Laboratoire;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratoireFactory extends Factory
{
    protected $model = Laboratoire::class;

    public function definition(): array
    {
        return [
            'nom' => 'Laboratoire ' . $this->faker->word(),
            'nom_ar' => 'مختبر ' . $this->faker->randomNumber(),
            'localisation' => $this->faker->city,

        ];
    }
}
