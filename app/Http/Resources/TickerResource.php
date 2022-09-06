<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TickerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'yourNumbers' => $this->numbers,
            'machineNumbers' => null,
            'winner' => false,
            'message' => 'not yet',
        ];
    }
}
