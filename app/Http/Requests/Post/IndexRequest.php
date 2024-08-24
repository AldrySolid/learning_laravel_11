<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id'              => 'nullable|integer',
            'title'           => 'nullable|string',
            'content'         => 'nullable|string',
            'created_at_from' => 'nullable|string',
            'created_at_to'   => 'nullable|string',
            'profile_id'      => 'nullable|exists:profiles,id',
            'page'            => 'nullable|integer'
        ];
    }

    public function passedValidation()
    {
        return $this->merge(
            [
                'page' => $this->page ?? 1
            ]
        );
    }
}
