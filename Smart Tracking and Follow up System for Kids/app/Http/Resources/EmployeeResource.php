<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
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
            "email"=>$this->email,
            "job_title"=>$this->job_title,
            "image"=>$imagename,
            "address"=>$this->address,
            "phone"=>$this->phone,
            "access_token"=>$this->access_token,
            "subjectdataset_id"=>$this->subjectdataset_id,
            "activitydataset_id"=>$this->activitydataset_id
        ];
        
    }
}
