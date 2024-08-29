<?php

namespace App\Http\Resources;

use Arr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Collection $tags */
        $tags = $this->tags;

        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'content'        => $this->content,
            'profile_id'     => $this->profile_id,
            'count_views'    => $this->count_views,
            'is_commentable' => $this->is_commentable,
            'tagsTitles'     => $tags->pluck('title', 'id')->toArray(),
            'image_path'     => isset($this->image_path)
                ? Storage::disk('public')->url($this->image_path)
                : null,
            'comments'       => Arr::mapWithKeys(
                CommentResource::collection($this->comments)->resolve(),
                function ($item) {
                    return [$item['id'] => $item];
                },
            )
        ];
    }
}
