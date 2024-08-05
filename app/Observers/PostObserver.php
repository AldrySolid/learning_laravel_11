<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\LogToDbService;
use App\Services\LogToFileService;

class PostObserver
{
    public function created(Post $post): void
    {
        LogToDbService::addLog($post, 'created');
        LogToFileService::addLog($post, 'created');
    }

    public function updated(Post $post): void
    {
        LogToDbService::addLog($post, 'updated');
        LogToFileService::addLog($post, 'updated');
    }

    public function deleted(Post $post): void
    {
        LogToDbService::addLog($post, 'deleted');
        LogToFileService::addLog($post, 'deleted');
    }

    public function retrieved(Post $post): void
    {
        // Отключен, так как генерирует кучу логов
        // LogToDbService::addLog($post, 'retrieved');
        // LogToFileService::addLog($post, 'retrieved');
    }
}
