<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Priest>
 */
class PriestFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            "firstname" => $this->faker->sentence(mt_rand(2, 8)),
            "secondname" => $this->faker->sentence(mt_rand(2, 8)),
            "slug" => $this->faker->slug(),
            "biography" => collect($this->faker->paragraphs(mt_rand(10, 20)))
                ->map(fn ($parag) => "<p>$parag</p>")->implode(''),
            "user_id"  => mt_rand(1, 5), // from total users that generated in DatabaseSeeder.php
        ];
    }
}
