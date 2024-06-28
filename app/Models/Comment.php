<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperComment
 */
class Comment extends Model
{
    use HasFactory;

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
}
