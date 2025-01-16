<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeLoanStoreRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
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
            'client_id.required' => 'The client ID is required.',
            'client_id.exists' => 'The selected client does not exist.',
            'property_value.required' => 'Property value is required.',
            'property_value.numeric' => 'Property value must be a numeric value.',
            'property_value.min' => 'Property value must be at least 0.',
            'down_payment.required' => 'Down payment is required.',
            'down_payment.numeric' => 'Down payment must be a numeric value.',
            'down_payment.min' => 'Down payment must be at least 0.',
        ];
    }
}
