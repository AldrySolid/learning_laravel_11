<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'profile_id'     => 'required|integer',
            'category_id'    => 'required|integer',
            'title'          => 'required|string',
            'content'        => 'required|string',
            'is_commentable' => 'required|boolean',
        ];
    }
}
