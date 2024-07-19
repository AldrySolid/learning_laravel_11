<?php

namespace App\Traits;

use App\Services\LogService;
use Illuminate\Database\Eloquent\Model;

trait HasLog
{
    protected static function booted()
    {
        static::created(function (Model $model) {
            LogService::addLog($model, 'created');
        });

        static::updated(function (Model $model) {
            LogService::addLog($model, 'updated');
        });

        static::deleted(function (Model $model) {
            LogService::addLog($model, 'deleted');
        });

        static::retrieved(function (Model $model) {
            // Отключен, так как генерирует кучу логов
            // LogService::addLog($model, 'retrieved');
        });

        parent::booted();
    }
}
