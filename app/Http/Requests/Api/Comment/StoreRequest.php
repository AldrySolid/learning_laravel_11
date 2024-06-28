<?php

namespace App\Http\Requests\Api\Comment;

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
            'profile_id'   => 'required|integer', // TODO Это ссылка на сущность
            'parent_class' => 'required|string',  // TODO Это класс сущности
            'parent_id'    => 'required|integer', // TODO Это идентификатор сущности
            'content'      => 'required|string',
        ];
    }
}
