<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdateRequest extends FormRequest
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

    public function passedValidation()
    {
        $result = $this;
        if (isset($this->image)) {
            $this->merge(
                [
                    'image_path' => Storage::disk('public')->put(
                        'images/posts', $this->image
                    )
                ]
            );
        }

        return $result;
    }
}
