<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id"=>$this->id,
            'name' => $this->name,
            'problem' => $this->problem,
            'from' => $this->from,
            'reason' => $this->reason,
            'take_action' => $this->take_action,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
