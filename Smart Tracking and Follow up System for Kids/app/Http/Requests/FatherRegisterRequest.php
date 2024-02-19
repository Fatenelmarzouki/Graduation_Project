<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FatherRegisterRequest extends FormRequest
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
            "name"=>"required|string|max:100",
            "email"=>"required|email",
            "password"=>"required|min:8|confirmed",
            "address"=>"string",
            "phone"=>"string",
            "gender"=>["required",Rule::in(["male","female"])], 
            "image"=>"file|nullable|mimes:jpg,png,jpeg,gif,webP",
        ];
    }
}
