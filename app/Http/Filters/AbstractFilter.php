<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class AbstractFilter
{
    /** @var array Массив ключей фильтрации */
    protected static array $_keys;

    /**
     * @param Builder $builder
     * @param array   $data
     *
     * @return Builder
     * @throws \Exception
     */
    public static function apply(Builder $builder, array $data): Builder
    {
        foreach (static::$_keys as $key) {
            if (!empty($data[$key])) {
                $methodName = Str::camel($key);

                if (!method_exists(static::class, $methodName)) {
                    throw new \Exception(
                        sprintf(
                            'Method "%s" not found in class "%s"',
                            $methodName,
                            static::class
                        )
                    );
                }

                static::$methodName($builder, $data[$key]);
            }
        }

        return $builder;
    }
}
