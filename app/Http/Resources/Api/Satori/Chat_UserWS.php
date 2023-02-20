<?php

namespace App\Http\Resources\Api\Satori;

use App\Models\Chat_User;
use Illuminate\Http\Resources\Json\JsonResource;

class Chat_UserWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Chat_User $this */
        $propierties = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'chat_id' => $this->chat_id,
        ];
        return $propierties;
    }
}
