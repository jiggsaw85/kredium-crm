<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashLoanUpdateRequest extends FormRequest
{
    /**
     * @return bool
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
            'amount' => 'required|numeric|min:0',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'The loan amount is required.',
            'amount.numeric' => 'The loan amount must be a numeric value.',
            'amount.min' => 'The loan amount must be at least 0.',
        ];
    }
}
