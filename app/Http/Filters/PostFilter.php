<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    protected static array $_keys = [
        'title',
        'category_title',
    ];

    protected static function title(Builder $builder, string $value)
    {
        $builder->where('title', 'ilike', "%$value%");
    }

    protected static function categoryTitle(Builder $builder, string $value)
    {
        $builder->whereRelation('category', 'title', 'ilike', "%$value%");
    }
}
