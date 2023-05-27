<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:apprentice,manager'],
            'candidate_number' => [
                'required_if:role,apprentice',
                'sometimes',
                'nullable',
                'min:000000',
                'max:999999',
                'numeric'
            ]
        ];
    }

    public function messages()
    {
        return [
            'candidate_number' => 'The candidate number must be 6 numbers'
        ];
    }
}
