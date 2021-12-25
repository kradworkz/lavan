<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'sometimes|required|string|max:150|unique:users,email,'.$this->id,
            'type' => 'sometimes|required|string',
            'name' => 'sometimes|required|string|max:100',
            'gender' => 'sometimes|required',
            'mobile' => 'sometimes|required|unique:users,mobile,'.$this->id,
        ];
    }
}
