<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperTag
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function posts(): BelongsToMany
    {
        return $this->BelongsToMany(Post::class)->withTimestamps();
    }
}
