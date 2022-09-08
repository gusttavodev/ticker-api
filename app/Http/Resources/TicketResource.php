<?php

namespace App\Http\Resources;

use App\Models\Prize;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'yourNumbers' => $this->numbers,
            'machineNumbers' => $this->prize?->numbers ? $this->prize->numbers : null,
            'winner' => $this->winner,
            'message' => $this->getMessage($this->created_at, $this->winner),
        ];
    }

    private function getMessage($createdAt, $winner)
    {
        if (empty(Prize::where('created_at', '>=', $createdAt)->first())) {
            return 'not yet';
        }
        if ($winner) {
            return 'winner';
        }
        return 'lose';
    }
}
