<?php

namespace App\Http\Requests;

use App\Models\Activitydataset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChildRegisterRequest extends FormRequest
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
        $a=[];
        $acts = Activitydataset::select("id")->get();
        foreach ($acts as $act) {
            $a[] = $act->id;
        }
        return [
            "name"=>"required|string|max:100",
            "age"=>"required|numeric|max:13",
            "grade"=>["required",Rule::in([1,2,3,4,5,6])],
            "gender"=>["required",Rule::in(["male","female"])],
            "weight"=> "required|numeric",
            "height"=> "required|numeric",
            "blood"=>["required",Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+','O-'])],
            "health_condition"=>["required",Rule::in(['normal', 'special'])],
            "image"=>"file|nullable|mimes:jpg,png,jpeg,gif,webP",
            "activitydataset_id"=>["required",Rule::in($a)]
        ];
    }
}
