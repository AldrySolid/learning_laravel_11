<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'author'      => $this->author,
            'first_name'  => $this->first_name,
            'second_name' => $this->second_name,
            'third_name'  => $this->third_name,
            'phone'       => $this->phone,
            'status'      => $this->status,
            'birthday'    => $this->birthday,
            'login'       => $this->login,
        ];
    }
}
