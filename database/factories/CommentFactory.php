<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CommentFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_class' => Post::class,
            'parent_id'    => Post::inRandomOrder()->get()->first(),
            'content'      => fake()->text(),
            'count_likes'  => fake()->randomNumber(2),
            'status'       => Comment::STATUS_PUBLISHED,
            'profile_id'   => Profile::inRandomOrder()->get()->first(),
        ];
    }
}
