<?php

namespace App\Services;

use App\Exceptions\PostException;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;

abstract class PostService
{
    public static function firstOrCreate(string $title): Post
    {
        return self::check('firstOrCreate', $title);
    }

    public static function updateOrCreate(string $title): Post
    {
        return self::check('updateOrCreate', $title);
    }

    /**
     * @param string $method
     *
     * @return Post
     * @throws PostException
     */
    protected static function check(string $method, string $title): Post
    {
        $post = Post::$method(['title' => $title], self::getRandomData());

        PostException::checkWasRecentlyCreated($post, $method);

        return $post;
    }

    /**
     * @return array
     */
    protected static function getRandomData(): array
    {
        return [
            'title'       => 'repudiandae',
            'content'     => 'content123',
            'category_id' => Category::inRandomOrder()->get()->first()->id,
            'profile_id'  => Profile::inRandomOrder()->get()->first()->id,
        ];
    }
}
