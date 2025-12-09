<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title'   => 'required|string',
            'content' => 'required|string',
        ];
    }
}
