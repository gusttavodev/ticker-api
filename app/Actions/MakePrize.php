<?php

namespace App\Actions;

use App\Models\Prize;
use App\Models\Ticket;
use Illuminate\Support\Collection;

class MakePrize
{
   public static function execute(Prize $prize): void
    {
        $tickets = self::getTicketsToDrawn($prize);

        $tickets->each(function ($ticket) use ($prize) {
            if (self::isDrawnTicket($ticket, $prize)) {
                $ticket->update(['winner' => true]);
            }
            $prize->tickets()->save($ticket);
        });
    }

    private static function getTicketsToDrawn(Prize $prize): Collection
    {
        return Ticket::whereDate(
            'created_at',
            '<=',
            $prize->created_at->subSecond(30)
        )->get();
    }

    private static function isDrawnTicket(Ticket $ticket, Prize $prize): bool
    {
        return collect($ticket->numbers)->diffAssoc($prize->numbers)->isEmpty();
    }
}
