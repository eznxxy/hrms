<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'company_name' => 'required|string',
            'chief' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'nullable|integer',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'phonecode' => 'nullable|integer',
            'phone' => 'nullable|integer',
            'telp' => 'nullable|string',
            'email' => 'nullable|string',
        ];
    }
}
