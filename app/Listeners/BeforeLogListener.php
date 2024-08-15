<?php

namespace App\Listeners;

use App\Events\BeforeLogEvent;
use Illuminate\Support\Facades\Log;

class BeforeLogListener
{
    public function handle(BeforeLogEvent $event): void
    {
        Log::channel('single')->info('Event Before Log');
    }
}
