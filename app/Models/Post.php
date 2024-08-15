<?php

namespace App\Models;

use App\Observers\PostObserver;
use App\Traits\Models\HasFilter;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;

/**
 * @mixin IdeHelperPost
 */
#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory;
    use HasFilter;

    protected $fillable = [
        'title',
        'content',
        'profile_id',
        'category_id',
        'is_commentable',
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

    public function comments(): MorphMany
    {
        return $this->morphMany(
            Comment::class,
            'commentable',
            'parent_class',
            'parent_id'
        );
    }

    public function update(array $attributes = [], array $options = [])
    {
        $this->tags()->sync($attributes['tags']);

        return parent::update($attributes, $options);
    }

    public function delete()
    {
        DB::transaction(function() {
            $this->tags()->sync([]);
            parent::delete();
        });
    }
}
