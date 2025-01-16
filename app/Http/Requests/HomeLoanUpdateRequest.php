<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeLoanUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'property_value' => 'required|numeric|min:0',
            'down_payment' => 'required|numeric|min:0',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'property_value.required' => 'Property value is required.',
            'property_value.numeric' => 'Property value must be a numeric value.',
            'property_value.min' => 'Property value must be at least 0.',
            'down_payment.required' => 'Down payment is required.',
            'down_payment.numeric' => 'Down payment must be a numeric value.',
            'down_payment.min' => 'Down payment must be at least 0.',
        ];
    }
}
