<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
            
            'name'=>'required|max:255',
            'age'=>'required|Max:16',
            'blood_type_id'=>'required|integer',
            'number_of_blood_cysts'=>'required|integer',
            'hospital_name'=>'required|string',
            'lat'=>'required|numeric',
            'lng'=>'required|numeric',
            'phone_number'=>'required|max:16',
            'notes'=>'nullable',
            'governorate_id' => 'required'
        ];
    }
}
