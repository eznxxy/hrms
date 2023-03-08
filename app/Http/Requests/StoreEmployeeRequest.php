<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'nik' => 'required|size:16',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string',
            'religion' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
            'email' => 'required|string',
            'password' => 'required|min:8',
            'position_id' => 'nullable|integer',
        ];
    }
}
