<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
            'middlename' => 'sometimes|required',
            'suffix' => 'sometimes|nullable',
            'gender' => 'sometimes|required',
            'birthday' => 'sometimes|required',
            'mobile' => 'sometimes|required|unique:patients,mobile,'.$this->id,
            'address' => 'sometimes|required',
            'barangay_id' => 'sometimes|required',
            'is_vaccinated' => 'nullable',
            'vaccine' => 'required_if:is_vaccinated,==,true'
        ];
    }

    public function messages()
    {
        $message = [
            'firstname.required' => 'required',
            'lastname.required' => 'required',
            'middlename.required' => 'required',
            'gender.required' => 'required',
            'birthday.required' => 'required',
            'mobile.required' => 'required',
            'address.required' => 'required',
            'barangay_id.required' => 'required',
        ];

        return $message;
    }
}
