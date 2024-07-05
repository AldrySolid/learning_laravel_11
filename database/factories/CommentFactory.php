<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory
 */
class CommentFactory extends Factory
{
    /**
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        /** @var Model $parentClass */
        $parentClass = random_int(1, 100) > 50
            ? Post::class
            : Profile::class;

        return [
            'parent_class' => $parentClass,
            'parent_id'    => $parentClass::inRandomOrder()->get()->first(),
            'content'      => fake()->text(),
            'count_likes'  => fake()->randomNumber(2),
            'status'       => Comment::STATUS_PUBLISHED,
            'profile_id'   => Profile::inRandomOrder()->get()->first(),
        ];
    }
}
