<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IssueRequest extends FormRequest
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
            "name" => "required|string|max:100",
            "problem" => "required|string|max:255",
            "from" => ["required", Rule::in(['Child', 'Employee', 'Family', 'Others'])],
            "reason" => ["required", Rule::in(['Psychologically', 'Healthily', 'Difficulty in Compatibility', 'Economically', 'Others'])],        
            "take_action" => "required|string|max:255",
        ];
    }
}
