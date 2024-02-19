<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildHealthRequest extends FormRequest
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
            "type"=>["required"],
            "medicien"=>"required|string|max:100",
            "medical_analysis"=>"required|string|max:100",
            "personal_comment"=>"required|string|max:100"
        ];
    }
}
