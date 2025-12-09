<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        $article = Article::find($this->route('article'));

        return $article && $article->profile_id == auth()->user()->profiles->first()->id;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles')->ignore($this->route('article'))
            ],
            'content' => 'required|string',
        ];
    }
}
