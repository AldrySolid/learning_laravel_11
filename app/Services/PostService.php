<?php

namespace App\Services;

use App\Exceptions\PostException;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

abstract class PostService
{
    const CACHE_KEY__POST_INDEX = 'posts.index';

    public static function index(array $data): AnonymousResourceCollection
    {
        $cacheKey = md5(serialize($data));

        return Cache::tags([self::CACHE_KEY__POST_INDEX])->remember(
            $cacheKey,
            now()->addHour(),
            function () use ($data) {
                return PostResource::collection(
                    Post::filter($data)->with('tags')->orderBy('id', 'desc')
                        ->paginate(3, ['*'], 'page', $data['page'])
                );
            }
        );
    }

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

            Cache::tags([self::CACHE_KEY__POST_INDEX])->flush();
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

            #region // Удаляем старое изображение
            {
                $before = $post->getOriginal();
                $after  = $post->getDirty();

                $beforeImagePath = $before['image_path'] ?? '';
                $afterImagePath  = $after['image_path'] ?? '';

                if ($beforeImagePath != $afterImagePath) {
                    Storage::disk('public')->delete($before['image_path']);
                }
            }
            #endregion

            $tagIds = TagService::storeBatch($data['tagsTitles']);
            $post->update($data);
            $post->tags()->sync($tagIds);

            DB::commit();

            Cache::tags([self::CACHE_KEY__POST_INDEX])->flush();
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

    public static function delete(Post $post): void
    {
        try {
            DB::beginTransaction();

            if (isset($post->image_path)) {
                Storage::disk('public')->delete($post->image_path);
            }

            $post->tags()->sync([]);
            $post->delete();

            DB::commit();

            Cache::tags([self::CACHE_KEY__POST_INDEX])->flush();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
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
