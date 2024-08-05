<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostChild;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tag;

use App\Services\PostService;
use Illuminate\Console\Command;

class go extends Command
{
    protected $signature = 'go {case}';

    protected $description = 'Test command';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        /** @var Post $post */
        $post = Post::inRandomOrder()->get()->first();
        /** @var Category $category */
        $category = Category::inRandomOrder()->get()->first();
        /** @var Tag $tag */
        $tag = Tag::inRandomOrder()->get()->first();
        /** @var Profile $profile */
        $profile = Profile::inRandomOrder()->get()->first();
        /** @var Comment $comment */
        $comment = Comment::inRandomOrder()->get()->first();
        /** @var Article $article */
        $article = Article::inRandomOrder()->get()->first();

        $result = null;

        switch ($this->argument('case')) {
            case 1:
                // Пост -> Профиль -> Юзер -> почта
                $result = $post->profile->user->email;
                break;
            case 2:
                // Категория -> Посты
                $result = $category->posts;
                break;
            case 3:
                // Пост -> Теги
                $result = $post->tags;
                break;
            case 4:
                // Тег -> Посты
                $result = $tag->posts;
                break;
            case 5:
                // Пост -> Категория -> Заголовок
                $result = $post->category->title;
                break;
            case 6:
                // Категория -> Профили
                $result = $category->profiles;
                break;
            case 7:
                // Профиль -> Категории
                $result = $profile->categories;
                break;
            // =================================
            // Полиморфные связи
            // =================================
            case 8:
                // Профиль -> Комментарии
                $result = $profile->comments;
                break;
            case 9:
                // Пост -> Комментарии
                $result = $post->comments;
                break;
            case 10:
                // Комментарий -> Родительская сущность
                $result = $comment->commentable;
                break;
            // =================================
            // Добавление сущности по связи
            // =================================
            case 11:
                // Пост -> Теги
                echo '============' . PHP_EOL;
                echo 'POST_ID = ' . $post->id . PHP_EOL;
                echo '- count tags = ' . $post->tags->count() . PHP_EOL;
                echo '- tags ids = ' . $post->tags->pluck('id') . PHP_EOL;

                $post->tags()->syncWithoutDetaching([10]);

                $post->refresh();
                echo '- - tag syncWithoutDetaching 10' . PHP_EOL;
                echo '- - tags ids result ' . $post->tags->pluck('id') . PHP_EOL;

                $post->tags()->sync([10]);
                $post->refresh();
                echo '- - tag sync 10' . PHP_EOL;
                echo '- - tags ids result ' . $post->tags->pluck('id') . PHP_EOL;

                $post->tags()->attach([1, 4, 5, 7]);
                $post->refresh();
                echo '- - tag attach 1,4,5,7' . PHP_EOL;
                echo '- - tags ids result ' . $post->tags->pluck('id') . PHP_EOL;

                $post->tags()->detach([5, 7]);
                $post->refresh();
                echo '- - tag detach 5 and 7' . PHP_EOL;
                echo '- - tags ids result ' . $post->tags->pluck('id') . PHP_EOL;

                $post->tags()->toggle([4]);
                $post->refresh();
                echo '- - tag toggle 4' . PHP_EOL;
                echo '- - tags ids result ' . $post->tags->pluck('id') . PHP_EOL;

                $post->tags()->toggle([4]);
                $post->refresh();
                echo '- - tag toggle 4' . PHP_EOL;
                echo '- - tags ids result ' . $post->tags->pluck('id') . PHP_EOL;

                echo '============' . PHP_EOL;

                $result = $post->id;
                break;
            // =================================
            // Тестирование логирования через Обозреватель
            // =================================
            case 12:
                /** @var Post $post */
                $post = Post::factory(1)->make()->first();
                $post = Post::create($post->attributesToArray());
                $post->refresh();

                $post->title = 'UPDATED ' . $post->title;
                $post->count_views++;
                $post->save();

                $post->delete();

                /** @var PostChild $post */
                $postChild = PostChild::factory(1)->make()->first();
                $postChild = PostChild::create($postChild->attributesToArray());
                $postChild->refresh();

                $postChild->title = 'UPDATED ' . $post->title;
                $postChild->count_views++;
                $postChild->save();

                $postChild->delete();

                break;
            // =================================
            // Тестирование логирования через Трейт
            // =================================
            case 13:
                /** @var Role $role */
                $role = Role::factory(1)->make()->first();
                $role = Role::create($role->attributesToArray());
                $role->refresh();

                $role->title = 'UPDATED ' . $role->title;
                $role->save();

                $role->delete();

                break;
            // =================================
            // Тестирование переопределения  через Трейт
            // =================================
            case 14:
                /** @var Article $article */
                $article = Article::factory(1)->make()->first();
                $article = Article::create($article->attributesToArray());
                $article->refresh();

                $article->title = 'UPDATED ' . $article->title;
                $article->save();

                $article->delete();

                break;
            // =================================
            // Логируем факт создания поста при поиске по title
            // =================================
            case 15:
                $title = 'random_title_' . fake()->title;
                PostService::firstOrCreate($title);


                break;
            // =================================
            // Логируем факт создания поста при обновлении по title
            // =================================
            case 16:
                $title = 'random_title_' . fake()->title;
                PostService::updateOrCreate($title);

                break;
            default:
                $this->fail();
        }
        //dd($result);
    }
}
