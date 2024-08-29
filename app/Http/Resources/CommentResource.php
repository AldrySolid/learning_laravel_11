<?php

namespace App\Http\Resources;

use App\Models\Profile;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'parent_class' => $this->parent_class,
            'parent_id'    => $this->parent_id,
            'profile'      => ProfileResource::make(Profile::find($this->profile_id))->resolve(),
            'content'      => $this->content,
            'count_likes'  => $this->count_likes,
            'status'       => $this->status,
            'created_at'   => $this->created_at->format('d.m.Y H:i'),
            'comments'     => Arr::mapWithKeys(
                CommentResource::collection($this->comments)->resolve(),
                function ($item) {
                    return [$item['id'] => $item];
                }
            ),
        ];
    }
}
