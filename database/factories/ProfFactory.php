<?php

namespace Database\Factories;

use App\Models\Prof;
use App\Models\User;
use App\Models\Laboratoire;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfFactory extends Factory
{
    protected $model = Prof::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nom' => $this->faker->lastName,
            'nom_ar' => 'الاسم_' . $this->faker->randomNumber(),
            'grade' => $this->faker->randomElement(['Professeur', 'Maître de Conférences', 'Assistant']),
            'etablissement' => $this->faker->company,
            'departement' => $this->faker->word,
            'type' => $this->faker->randomElement(['Permanent', 'Vacataire']),
            // database/factories/ProfFactory.php
            'sexe' => $this->faker->randomElement(['M', 'F']),

            'id_laboratoire' => Laboratoire::factory(),
        ];
    }
}
