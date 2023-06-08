<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApprenticeModuleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start_date' => 'nullable|date|date_format:Y-m-d',
            'end_date' => 'nullable|date|after_or_equal:start_date|date_format:Y-m-d',
            'grade' => 'nullable|numeric|min:0|max:100',
        ];
    }
}
