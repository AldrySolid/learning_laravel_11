<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\LogService;

class PostObserver
{
    public function created(Post $post): void
    {
        LogService::addLog($post, 'created');
    }

    public function updated(Post $post): void
    {
        LogService::addLog($post, 'updated');
    }

    public function deleted(Post $post): void
    {
        LogService::addLog($post, 'deleted');
    }

    public function retrieved(Post $post): void
    {
        // Отключен, так как генерирует кучу логов
        // LogService::addLog($post, 'retrieved');
    }
}
