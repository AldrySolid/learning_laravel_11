<?php

namespace App\Http\Resources;

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
            'profile_id'   => $this->profile_id,
            'content'      => $this->content,
            'count_likes'  => $this->count_likes,
            'status'       => $this->status,
        ];
    }
}
