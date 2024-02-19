<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'name'=>$this->name,
            'problem'=>$this->problem,
            'take_action'=>$this->take_action,
            'requirements'=>$this->requirements,
            'father_reply'=>$this->father_reply,
            'created_at'=>$this->created_at->format('Y-m-d'),
        ];
    }
}
