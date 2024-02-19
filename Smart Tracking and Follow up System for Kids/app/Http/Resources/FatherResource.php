<?php

namespace App\Http\Resources;

use App\Models\Father;
use Illuminate\Http\Resources\Json\JsonResource;

class FatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->image == null) {
            $imagename = null;
        } else {
            $imagename = asset("storage") . "/" . $this->image;
        }
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "username"=>$this->username,
            "password"=>$this->password,
            "address"=>$this->address,
            "phone"=>$this->phone,
            "gender"=>$this->gender,
            "image"=>$imagename,
            "access_token"=>$this->access_token,
            "status"=>$this->status,
        ];
    }
}
