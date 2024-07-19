<?php

namespace App\Services;

use App\Events\BeforeLogEvent;
use App\Events\AfterLogEvent;
use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

class LogService
{
    /**
     * @param Model  $model
     * @param string $event
     */
    public static function addLog(Model $model, string $event): void
    {
        try {
            BeforeLogEvent::dispatch();

            $before = [];
            $after  = [];

            switch ($event) {
                case 'created':
                case 'created123':
                    $after = $model->getDirty();
                    break;
                case 'deleted':
                    $before = $model->getOriginal();
                    break;
                case 'updated':
                    $before = $model->getOriginal();
                    $after  = $model->getDirty();

                    // Сохраняем только то что изменилось
                    $afterDiff  = array_diff_assoc($after, $before);
                    $beforeDiff = array_intersect_key($before, $afterDiff);

                    $before = $beforeDiff;
                    $after  = $afterDiff;
                    break;
            }

            // Вырезаем лишние поля
            $before = array_diff_key(
                $before,
                array_flip((array)['created_at', 'updated_at', 'deleted_at'])
            );
            $after  = array_diff_key(
                $after,
                array_flip((array)['created_at', 'updated_at', 'deleted_at'])
            );

            $log = [
                'parent_class' => get_class($model),
                'parent_id'    => $model->id,
                'event'        => $event,
            ];

            $log['before'] = json_encode(
                $before,
                JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT
            );
            $log['after']  = json_encode(
                $after,
                JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT
            );

            Log::create($log);
        } finally {
            AfterLogEvent::dispatch();
        }
    }
}
