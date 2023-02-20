<?php

namespace App\Http\Resources\Api\Satori;

use App\Models\Chat_User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class UserWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var User $this */
        $propierties = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'api_token' => $this->api_token,
            'type_user' => $this->type_user,
        ];
        return $propierties;
    }
}
