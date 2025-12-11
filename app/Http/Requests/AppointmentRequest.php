<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'phone.required' => 'Please enter your phone number',
            'email.required' => 'Please enter your email address',
        ];
    }
}
