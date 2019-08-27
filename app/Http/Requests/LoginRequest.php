<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            //
            
            'phone_number'=>'required',
            'password'=>'required',
            'phone_token'=>'nullable',
            'type' => 'nullable'
        ];
    }

    public function messages() {
        return [
            'phone_number.required' => "رقم الهاتف  مطلوب",
            'password.required' => "الرقم السري مطلوب",
            
        ];
    }
}
