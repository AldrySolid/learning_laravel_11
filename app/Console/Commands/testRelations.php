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

    protected Category $_category;

    protected Post $_post;

    protected Tag $_tag;

    public function __construct()
    {
        $this->_post     = Post::inRandomOrder()->get()->first();
        $this->_category = Category::inRandomOrder()->get()->first();
        $this->_tag      = Tag::inRandomOrder()->get()->first();

        parent::__construct();
    }

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        $result = null;

        switch ($this->argument('case')) {
            case 1:
                // Пост -> Профиль -> Юзер -> почта
                $result = $this->_post->profile->user->email;
                break;
            case 2:
                // Категория -> Посты
                $result = $this->_category->posts;
                break;
            case 3:
                // Пост -> Теги
                $result = $this->_post->tags;
                break;
            case 4:
                // Тег -> Посты
                $result = $this->_tag->posts;
                break;
            case 5:
                // Пост -> Категория -> Заголовок
                $result = $this->_post->category->title;
                break;
            default:
                $this->fail();
        }

        dd($result);
    }
}
