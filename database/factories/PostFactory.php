<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class PostFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'          => 'Post ' . fake()->words(5, true),
            'content'        => fake()->text(),
            'count_views'    => fake()->randomNumber(3),
            'is_commentable' => 1,
            'category_id'    => Category::inRandomOrder()->get()->first(),
            'profile_id'     => Profile::inRandomOrder()->get()->first(),
        ];
    }
}
