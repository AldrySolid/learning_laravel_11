<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

abstract class ProfileService
{
    /**
     * @return Collection
     */
    public static function getMyPosts(): Collection
    {
        /** @var Profile $profile */
        $profile = auth()->user()->profiles()->first();

        return $profile->posts;
    }
}
