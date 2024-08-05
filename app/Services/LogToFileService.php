<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Monolog\Formatter\LineFormatter;

class LogToFileService extends LogService
{
    const CFG = 'logging.channels.%s';

    /**
     * @param Model  $model
     * @param string $event
     */
    public static function addLog(Model $model, string $event): void
    {
        $channel = self::getChannel($model);
        $title   = self::getTitle($model, $event);
        $context = parent::getContext($model, $event);

        Log::channel($channel)->info($title, $context);
    }

    protected static function getTitle(Model $model, string $event): string
    {
        return sprintf(
            'Model "%s" Event "%s"',
            get_class($model),
            $event
        );
    }

    protected static function getChannel(Model $model): string
    {
        $channel = sprintf(
            '%s_%u',
            Str::lower(class_basename($model)),
            $model->id
        );

        $logFileName = "logs/$channel.log";

        $cfg = sprintf(self::CFG, $channel);
        Config::set($cfg,
            [
                'driver'         => 'single',
                'path'           => storage_path($logFileName),
                'formatter'      => LineFormatter::class,
                'formatter_with' => [
                    'format' => "[%datetime%]  %message% %context% %extra%\n",
                ],
            ]
        );

        return $channel;
    }
}
