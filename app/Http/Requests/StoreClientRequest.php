<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string|max:15',
            'cash_loan'  => 'required|boolean',
            'home_loan'  => 'required|boolean',
            'contact'    => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'contact.required'    => 'Either email or phone is required.',
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'cash_loan' => filter_var($this->cash_loan, FILTER_VALIDATE_BOOLEAN),
            'home_loan' => filter_var($this->home_loan, FILTER_VALIDATE_BOOLEAN),
            'contact'   => $this->email || $this->phone ? 'valid' : null,
        ]);
    }
}
