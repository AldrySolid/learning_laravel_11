<?php

namespace App\Traits\Models;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    /**
     * @param Builder $builder
     * @param array   $data
     *
     * @return Builder
     * @throws \Exception
     */
    public function scopeFilter(Builder $builder, array $data): Builder
    {
        $className = sprintf(
            "App\\Http\\Filters\\%sFilter",
            class_basename($this)
        );

        if (!class_exists($className)) {
            throw new \Exception(
                sprintf(
                    'Class "%s" not found',
                    $className
                )
            );
        }

        /** @var AbstractFilter $className */
        return $className::apply($builder, $data);
    }
}
