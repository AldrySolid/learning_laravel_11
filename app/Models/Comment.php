<?php

namespace App\Models;

use App\Traits\Models\HasComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin IdeHelperComment
 */
class Comment extends Model
{
    use HasFactory;
    use HasComment;

    const STATUS_MODERATE  = 1;
    const STATUS_PUBLISHED = 2;

    protected $fillable = [
        'parent_class',
        'parent_id',
        'profile_id',
        'content',
        'count_likes',
        'status',
    ];

    public function profile(): belongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo(
            'commentable',
            'parent_class',
            'parent_id'
        );
    }
}
