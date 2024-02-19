<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthdatasettypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "dis_type"=>$this->dis_type,
            "admin_id"=>$this->admin_id,
            "healthdatasetname_id"=>$this->healthdatasetname_id
        ];
    }
}
