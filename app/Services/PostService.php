<?php

namespace App\Services;

use App\Exceptions\PostException;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

abstract class PostService
{
    public static function firstOrCreate(string $title): Post
    {
        return self::check('firstOrCreate', $title);
    }

    /**
     * @param array $data
     *
     * @return Post
     * @throws \Throwable
     */
    public static function store(array $data): Post
    {
        try {
            DB::beginTransaction();

            $tagIds = TagService::storeBatch($data['tagsTitles']);
            $post   = Post::create($data);
            $post->tags()->attach($tagIds);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }

        return $post;
    }

    public static function update(Post $post, array $data): Post
    {
        try {
            DB::beginTransaction();

            // Удаляем старое изображение
            {
                $before = $post->getOriginal();
                $after  = $post->getDirty();

                $beforeImagePath = $before['image_path'] ?? '';
                $afterImagePath  = $after['image_path'] ?? '';

                if ($beforeImagePath != $afterImagePath) {
                    Storage::disk('public')->delete($before['image_path']);
                }
            }

            $tagIds = TagService::storeBatch($data['tagsTitles']);
            $post->update($data);
            $post->tags()->sync($tagIds);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }

        return $post;
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
