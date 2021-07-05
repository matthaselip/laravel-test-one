<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'companies_id' => 'required|exists:companies,companies_id',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|max:20'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required',
            'first_name.max' => 'Maximum number of characters has been exceed',
            'last_name.required' => 'Last Name is Required',
            'last_name.max' => 'Maximum number of characters has been exceed',
            'companies_id.required' => 'Company is required',
            'companies_id.exists' => 'Company must already exist in the database',
            'email.email' => 'Email must be in the correct format',
            'email.max' => 'Email must no contain more than 100 characters',
            'phone.max' => 'Phone number must not contain more than 20 characters'
        ];
    }
}
