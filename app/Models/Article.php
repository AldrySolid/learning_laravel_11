<?php

namespace App\Models;

use App\Services\LogService;
use App\Traits\Models\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin IdeHelperArticle
 */
class Article extends Model
{
    use HasFactory;
    use HasLog {
        HasLog::booted as private trait_booted;
    }

    protected $fillable = [
        'title',
        'content',
        'profile_id',
    ];

    protected static function booted()
    {
        self::trait_booted();

        static::getEventDispatcher()->forget(
            "eloquent.created: " . static::class
        );

        static::created(function (Article $article) {
            LogService::addLog($article, 'created123');
        });
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->BelongsToMany(Tag::class)->withTimestamps();
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
