<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertNewHealthRequest extends FormRequest
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
            "name"=>"required|string|max:50",
            "type"=>"required|string|max:50",
            "banded_food"=>"required|string|max:50",
            "medicien"=>"string|nullable|max:100",
            "medical_analysis"=>"file|nullable|mimes:jpg,png,jpeg,gif,webP",
            "personal_comment"=>"string|nullable|max:255"
        ];
    }
}
