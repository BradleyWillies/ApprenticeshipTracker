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
//        return [
//            'modules' => 'required|array',
//            'modules.*' => 'exists:modules,id',
//            'start_dates' => 'required|array',
//            'start_dates.*' => 'nullable|date|date_format:Y-m-d',
//            'end_dates' => 'required|array',
//            'end_dates.*' => 'date|after_or_equal:start_dates.*|nullable|date_format:Y-m-d',
//        ];

        $rules = [
            'modules' => 'required|array',
            'modules.*' => 'exists:modules,id',
        ];

        foreach ($this->input('modules', []) as $moduleId) {
            $rules["start_dates.{$moduleId}"] = "nullable|date|date_format:Y-m-d";
            $rules["end_dates.{$moduleId}"] = "date|after_or_equal:start_dates.{$moduleId}|nullable|date_format:Y-m-d";
        }

//        dd($rules);
        return $rules;
        // Apply the rules to the request
//        $this->validate($rules, $this->messages());
    }

    public function messages()
    {
//        return [
//            'modules.required' => 'At least one module must be selected.',
//            'end_dates.*.after_or_equal' => 'The end date must be after or equal to the start date.',
//        ];

        $messages = [
            'modules.required' => 'At least one module must be selected.',
        ];

        foreach ($this->input('modules', []) as $moduleId) {
            $messages["end_dates.{$moduleId}.after_or_equal"] = "The end date must be after or equal to the start date.";
        }

        return $messages;
    }
}
