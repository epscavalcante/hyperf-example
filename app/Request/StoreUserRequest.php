<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class StoreUserRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ];
    }

    /**
     * Get the error message of the defined validation rule
     */
    public function messages(): array
    {
        return [
            'name.required' => 'name is required',
            'name.string' => 'name is not stirng',
            'name.max' => 'name is too long',
            'email.required' => 'email is required',
            'email.email' => 'email is not valid',
        ];
    }
}
