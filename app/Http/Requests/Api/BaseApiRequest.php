<?php
namespace App\Http\Requests\Api;

use App\Helpers\HelperFunc;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseApiRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();

        // Transform errors to a more API-friendly format
        $formattedErrors = [];
        foreach ($errors as $field => $messages) {
            $formattedErrors[$field] = $messages[0]; // Take first error message
        }

        throw new HttpResponseException(
            HelperFunc::sendResponse(422, 'Validation failed', [
                'errors'  => $formattedErrors,
                'message' => 'The given data was invalid.',
            ])
        );
    }
}