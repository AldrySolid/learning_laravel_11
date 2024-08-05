<?php

namespace App\Traits\Models;

use App\Services\LogToDbService;
use App\Services\LogToFileService;
use Illuminate\Database\Eloquent\Model;

trait HasLog
{
    protected static function booted()
    {
        static::created(function (Model $model) {
            LogToDbService::addLog($model, 'created');
            LogToFileService::addLog($model, 'created');
        });

        static::updated(function (Model $model) {
            LogToDbService::addLog($model, 'updated');
            LogToFileService::addLog($model, 'updated');
        });

        static::deleted(function (Model $model) {
            LogToDbService::addLog($model, 'deleted');
            LogToFileService::addLog($model, 'deleted');
        });

        static::retrieved(function (Model $model) {
            // Отключен, так как генерирует кучу логов
            // LogToDbService::addLog($model, 'retrieved');
            // LogToFileService::addLog($model, 'retrieved');
        });

        parent::booted();
    }
}
