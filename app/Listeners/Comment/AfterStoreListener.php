<?php

namespace App\Listeners\Comment;

use App\Events\Comment\AfterStoreEvent;
use App\Mail\Comment\Stored;
use Illuminate\Support\Facades\Mail;

class AfterStoreListener
{
    public function handle(AfterStoreEvent $event): void
    {
        $comment = $event->getComment();

        Mail::to('casey.brave91@mediakilo.com')
            ->send(new Stored($comment));
    }
}
