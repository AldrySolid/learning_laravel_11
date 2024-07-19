<?php

namespace App\Listeners;

use App\Events\AfterLogEvent;

class AfterLogListener
{
    public function handle(AfterLogEvent $event): void
    {
        dump('Event After Log');
    }
}
