<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'   => 'required|string',
            'content' => 'required|string',
            'tags'    => 'required|array',
            'image'   => 'nullable|file',
        ];
    }
}
