<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\this  $this
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->image==null){
            $imagename=null;
        }else{
            $imagename=asset("storage")."/".$this->image;
        }
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "age"=>$this->age,
            "grade"=>$this->grade,
            "gender"=>$this->gender, 
            "weight"=> $this->weight,
            "height"=>$this->height,
            "blood"=>$this->blood,
            "health_condition"=>$this->health_condition,
            "image"=>$imagename,
            "updated_at"=>$this->updated_at,
            "created_at"=>$this->created_at,
            "activitydataset_id"=>$this->activitydataset_id,
            "qr_code"=>asset("storage/QrCodes")."/".$this->qr_code,
            "child_code"=>$this->child_code,
            "qr_string"=>$this->qr_string
        ];
    }
}
