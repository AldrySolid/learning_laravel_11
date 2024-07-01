<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Console\Command;

class testRelations extends Command
{
    protected $signature = 'testRelations {case}';

    protected $description = 'Test relations';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        $post     = Post::inRandomOrder()->get()->first();
        $category = Category::inRandomOrder()->get()->first();
        $tag      = Tag::inRandomOrder()->get()->first();

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
            default:
                $this->fail();
        }

        dd($result);
    }
}
