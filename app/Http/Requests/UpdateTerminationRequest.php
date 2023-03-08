<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTerminationRequest extends FormRequest
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
            'termination_category_id' => 'required|integer',
            'noticed_at' => 'required|date',
            'terminated_at' => 'required|date',
            'description' => 'required|string|max:255',
        ];
    }
}
