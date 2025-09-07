<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'email'         => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($this->route('employee')),
            ],
            'department_id' => 'required|exists:departments,id',
            'salary'        => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'          => 'The employee name is required.',
            'email.required'         => 'The email address is required.',
            'email.email'            => 'Please provide a valid email address.',
            'email.unique'           => 'This email address is already taken.',
            'department_id.required' => 'Please select a department.',
            'department_id.exists'   => 'The selected department does not exist.',
            'salary.required'        => 'The salary is required.',
            'salary.numeric'         => 'The salary must be a number.',
            'salary.min'             => 'The salary must be at least 0.',
        ];
    }
}