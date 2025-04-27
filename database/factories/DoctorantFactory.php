<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctorant>
 */
class DoctorantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'cne' => strtoupper(fake()->bothify('??######')),
            'cin' => strtoupper(fake()->bothify('??#####')),
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'nom_ar' => 'الاسم',
            'prenom_ar' => 'اللقب',
            'date_naissance' => fake()->date(),
            'lieu_naissance' => fake()->city(),
            'nationalite' => 'Marocain',
            'sexe' => $this->faker->randomElement(['M', 'F']), // أو ['Homme', 'Femme'] حسب قاعدة البيانات

            'fonctionnaire' => fake()->boolean(),
            'bourse' => fake()->boolean(),
            'formation' => fake()->word(),
            'sujet' => fake()->sentence(),
            'id_prof' => \App\Models\Prof::factory(),
            'id_laboratoire' => \App\Models\Laboratoire::factory(),
            'date_soutenance' => fake()->optional()->date(),
            'situation' => fake()->randomElement(['Inscrit', 'Soutenu']),
            'these' => fake()->sentence(),
            'mention' => fake()->randomElement(['Bien', 'Très Bien', 'Excellent']),
        ];
    }

}
