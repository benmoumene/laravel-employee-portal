<?php

namespace App\Http\Requests\HR\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTimelineEventRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'document' => 'nullable|file',
        ];
    }
}
