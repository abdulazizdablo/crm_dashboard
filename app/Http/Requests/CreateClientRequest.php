<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'contact_name' => 'required|string',
            'contact_email' => 'required|unique:clients|email',
            'contact_phone_number' => 'required|string',
            'company_vat' => 'required|digits_between:1,7',
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'company_city' => 'required|string',
            'company_zip' => 'required|digits_between:1,7'
        ];
    }
}
