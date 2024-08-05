<?php

namespace App\Services;

use App\Events\BeforeLogEvent;
use App\Events\AfterLogEvent;
use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

class LogToDbService extends LogService
{
    /**
     * @param Model  $model
     * @param string $event
     */
    public static function addLog(Model $model, string $event): void
    {
        try {
            BeforeLogEvent::dispatch();

            $log = static::getContext($model, $event);

            Log::create($log);
        } finally {
            AfterLogEvent::dispatch();
        }
    }
}
