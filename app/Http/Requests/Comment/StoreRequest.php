<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'profile_id'   => 'required|integer|exists:profiles,id',
            'parent_class' => 'required|string',
            'parent_id' => 'required|integer',
            'title' => 'required|string',
            'content' => 'required|string|max:255',
        ];
    }
}
