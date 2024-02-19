<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MidecalAnalysisResource extends JsonResource
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
            "created_at"=>$this->created_at->format('Y-m-d'),
            "medical_analysis"=>$imagename,
        ];
    }
}
