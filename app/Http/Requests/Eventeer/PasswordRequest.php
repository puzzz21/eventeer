<?php

namespace App\Http\Requests\Eventeer;

//use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_pass' => 'required',
            'new_pass'     => 'required',
            're_new_pass'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'current_pass.required' => 'Current Password is required.',
            'new_pass.required'     => 'New Password is required.',
            're_new_pass.required'  => 'Retyped Password is required.'
        ];
    }
}
