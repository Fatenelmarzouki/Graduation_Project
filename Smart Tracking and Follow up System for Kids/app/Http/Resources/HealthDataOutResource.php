<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthDataOutResource extends JsonResource
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
        ];
    }
}
