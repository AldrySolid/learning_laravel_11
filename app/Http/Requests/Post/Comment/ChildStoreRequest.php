<?php

namespace App\Http\Requests\Post\Comment;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class ChildStoreRequest extends FormRequest
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
                'parent_class' => Comment::class,
                'profile_id'   => auth()->user()->profiles->first()->id,
            ]
        );

        return $result;
    }
}
