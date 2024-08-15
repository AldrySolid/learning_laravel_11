<?php

namespace App\Listeners;

use App\Events\AfterLogEvent;
use Illuminate\Support\Facades\Log;

class AfterLogListener
{
    public function handle(AfterLogEvent $event): void
    {
        Log::channel('single')->info('Event After Log');
    }
}
