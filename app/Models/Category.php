<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }

    public function profiles(): HasManyThrough
    {
        return $this->hasManyThrough(
            Profile::class,
            Post::class,
            'profile_id',
            'id',
            'id',
            'profile_id'
        );
    }
}
