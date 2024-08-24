<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    protected static array $_keys = [
        'id',
        'title',
        'content',
        'category_title',
        'created_at_from',
        'created_at_to',
        'profile_id',
    ];

    protected static function id(Builder $builder, int $value)
    {
        $builder->where('id', '=', $value);
    }

    protected static function title(Builder $builder, string $value)
    {
        $builder->where(
            'title', 'ilike', "%$value%"
        );
    }

    protected static function profileId(Builder $builder, string $value)
    {
        $builder->where(
            'profile_id', '=', $value
        );
    }

    protected static function content(Builder $builder, string $value)
    {
        $builder->where(
            'content', 'ilike', "%$value%"
        );
    }

    protected static function categoryTitle(Builder $builder, string $value)
    {
        $builder->whereRelation(
            'category', 'title',
            'ilike', "%$value%"
        );
    }

    protected static function createdAtFrom(Builder $builder, string $value)
    {
        $builder->whereDate(
            'created_at', '>=', $value
        );
    }

    protected static function createdAtTo(Builder $builder, string $value)
    {
        $builder->whereDate(
            'created_at', '<', $value
        );
    }
}
