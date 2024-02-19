<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildDataResource extends JsonResource
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
        return[
            "id"=>$this->id,
            "name" => $this->name,
            "grade" => $this->grade,
            "class" => $this->class,
            "image" => $imagename,
            "health_condition"=>$this->health_condition
        ];
    }
}
