<?php

namespace App\Http\Requests;

use App\Models\Healthdatasettype;
use Illuminate\Foundation\Http\FormRequest;

class HealthRequest extends FormRequest
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
            "dis_type"=>["required"],
            "medicien"=>"required|string|max:100",
            "medical_analysis"=>"file|nullable|mimes:jpg,png,jpeg,gif,webP",
            "personal_comment"=>"required|string|max:100"
        ];
    }
}
