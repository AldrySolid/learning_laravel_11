<?php

namespace App\Services;

use App\Models\Tag;

abstract class TagService
{
    /**
     * @param string[] $tagsTitles
     *
     * @return int[]
     */
    public static function storeBatch(array $tagsTitles): array
    {
        $tagsIds = [];
        foreach ($tagsTitles as $tagTitle) {
            $tagsIds[] = Tag::firstOrCreate(
                ['title' => $tagTitle]
            )->id;
        }

        return $tagsIds;
    }
}
