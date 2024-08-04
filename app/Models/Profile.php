<?php

namespace App\Models;

use App\Traits\Models\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin IdeHelperProfile
 */
class Profile extends Model
{
    use HasFactory;
    use HasLog;

    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'user_id',
        'first_name',
        'second_name',
        'third_name',
        'phone',
        'status',
        'birthday',
        'login',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(
            Category::class,
            Post::class,
            'category_id',
            'id',
            'id',
            'category_id'
        );
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(
            Comment::class,
            'commentable',
            'parent_class',
            'parent_id'
        );
    }
}
