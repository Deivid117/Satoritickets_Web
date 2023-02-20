<?php

namespace App\Http\Resources\Api\Satori;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Tickets;

class TicketWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Tickets $this */
        $propierties = [
            'id' => $this->id,
            'no_ticket' => $this->no_ticket,
            'project' => $this->project,
            'team' => $this->team,
            'date' => $this->date,
            'user_id' => $this->user_id,
            'creator_id' => $this->creator_id,
            'content' => $this->content,
            'pdf' => $this->pdf,
            'status' => $this->status
        ];
        return $propierties;
    }
}
