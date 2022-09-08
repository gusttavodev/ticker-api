<?php

namespace App\Actions;

use App\Models\Prize;
use App\Models\Ticket;

class MakePrize
{
    public static function execute(Prize $prize): void
    {
        Ticket::whereDate(
            'created_at',
            '<=',
            $prize->created_at->subSecond(30)
        )->each(function ($value) use ($prize) {
            if (collect($value->numbers)->diffAssoc($prize->numbers)->isEmpty()) {
                $value->update(['winner' => true]);
            }
            $prize->tickets()->save($value);
        });
    }
}
