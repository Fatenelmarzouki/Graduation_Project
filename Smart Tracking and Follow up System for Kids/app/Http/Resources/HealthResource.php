<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->medical_analysis==null){
            $imagename=null;
        }else{
            $imagename=asset("storage")."/".$this->medical_analysis;
        }
        return [
            "banded_food"=>$this->banded_food,
            "medicien"=>$this->medicien,
            "medical_analysis"=>$imagename,
            "personal_comment"=>$this->personal_comment,
            "father_id"=>$this->father_id,
            "child_id"=>$this->child_id,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at
        ];
    }
}
