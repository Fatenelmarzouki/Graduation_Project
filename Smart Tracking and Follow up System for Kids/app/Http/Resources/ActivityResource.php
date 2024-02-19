<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'performance_evaluation'=>$this->performance_evaluation,
            'team_work'=>$this->team_work,
        ];
    }
}
