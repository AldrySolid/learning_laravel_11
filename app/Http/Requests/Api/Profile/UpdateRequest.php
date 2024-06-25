<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name'  => 'required|string',
            'second_name' => 'required|string',
            'third_name'  => 'required|string',
            'phone'       => 'required|string',
            'status'      => 'required|integer',
            'birthday'    => 'nullable|date',
            'login'       => 'nullable|string',
        ];
    }
}
