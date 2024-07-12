<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ArticleFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'      => 'Article ' . fake()->words(5, true),
            'content'    => fake()->text(),
            'profile_id' => Profile::inRandomOrder()->get()->first(),
        ];
    }
}
