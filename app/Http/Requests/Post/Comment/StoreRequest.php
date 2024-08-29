<?php

namespace App\Http\Requests\Post\Comment;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string',
        ];
    }

    public function passedValidation()
    {
        $result = $this;

        $this->merge(
            [
                'parent_class' => Post::class,
                'profile_id'   => auth()->user()->profiles->first()->id,
            ]
        );

        return $result;
    }
}
