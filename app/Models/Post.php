<?php

namespace App\Models;

use App\Observers\PostObserver;
use App\Traits\Models\HasComment;
use App\Traits\Models\HasFilter;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperPost
 */
#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory;
    use HasFilter;
    use HasComment;

    protected $fillable = [
        'title',
        'content',
        'profile_id',
        'category_id',
        'is_commentable',
        'image_path',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->BelongsToMany(Tag::class)->withTimestamps();
    }
}
