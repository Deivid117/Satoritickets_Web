<?php

namespace App\Http\Resources\Api\Satori;

use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Message $this */
        $propierties = [
            'id' => $this->id,
            'content' => $this->content,
            'seen_message' => $this->seen_message,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'chat_id' => $this->chat_id,
            'message_date' => $this->message_date,
            'message_hour' => $this->message_hour,
        ];
        return $propierties;
    }

}
