<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddApprenticeModulesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'modules' => 'required|array',
            'modules.*' => 'exists:modules,id',
            'start_dates' => 'required|array',
            'start_dates.*' => 'nullable|date|date_format:Y-m-d',
            'end_dates' => 'required|array',
            'end_dates.*' => 'date|after_or_equal:start_dates.*|nullable|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'modules.required' => 'At least one module must be selected.',
            'end_dates.*.after_or_equal' => 'The end date must be after or equal to the start date.',
        ];
    }
}
