<?php
namespace App\Http\Requests\Api;

class RegisterRequest extends BaseApiRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'The name is required.',
            'name.max'           => 'The name must be less than 255 characters.',
            'email.required'     => 'The email address is required.',
            'email.email'        => 'Please provide a valid email address.',
            'email.unique'       => 'This email address is already taken.',
            'password.required'  => 'The password is required.',
            'password.min'       => 'The password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
