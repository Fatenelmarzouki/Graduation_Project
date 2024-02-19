<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'mark'=>$this->mark,
            'behavior'=>$this->behavior,
            'activity'=>$this->activity,
            'interact'=>$this->interact,
            'team_work'=>$this->team_work,
        ];
    }
}
