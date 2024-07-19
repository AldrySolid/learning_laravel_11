<?php

namespace App\Listeners;

use App\Events\BeforeLogEvent;

class BeforeLogListener
{
    public function handle(BeforeLogEvent $event): void
    {
        dump('Event Before Log');
    }
}
