<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ElderFounder>
 */
class ElderFounderFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            "firstname" => $this->faker->sentence(mt_rand(2, 4)),
            "secondname" => $this->faker->sentence(mt_rand(2, 4)),
            "slug" => $this->faker->slug(),
            "biography" => collect($this->faker->paragraphs(mt_rand(12, 18)))
                ->map(fn ($parag) => "<p>$parag</p>")->implode(''),
            "user_id"  => mt_rand(1, 4), // from total users that generated in DatabaseSeeder.php
        ];
    }
}
