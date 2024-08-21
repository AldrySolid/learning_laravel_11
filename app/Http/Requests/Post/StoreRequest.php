<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'      => 'required|string',
            'content'    => 'required|string',
            'tagsTitles' => 'required|array',
            'image'      => 'nullable|file',
        ];
    }

    public function passedValidation()
    {
        $result = $this;

        $this->merge(
            [
                'profile_id'  => auth()->user()->profiles->first()->id,
                'category_id' => 1
            ]
        );

        return $result;
    }
}
