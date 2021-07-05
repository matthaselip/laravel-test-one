<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|dimensions:min_width=100,min_height=100'
        ];
    }

    /**
     * overwriting message responses
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'name field is required',
            'name.max' => 'maximum number of characters is 50',
            'email.required' => 'email field is required',
            'email.max' => 'maximum number of characters is 100',
            'email.email' => 'you must provide a valid email',
            'logo.dimensions' => 'Image Width and Height must be a minimum of 100px',
            'logo.mimes' => 'Image you are uploading must be a jpg file type'
        ];
    }
}
