<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\TickerResource;
use App\Http\Resources\TicketResource;
use App\Http\Requests\Ticket\StoreRequest;

class TicketController extends Controller
{
    public function store(StoreRequest $request)
    {
        $inputs = $request->validated();

        $ticket = Ticket::create([
            'name' => $inputs['name'],
            'numbers' => json_encode($inputs['numbers']),
            'code' => (string) Str::uuid()
        ]);

        return response()->json(['ticketCode' => $ticket->code]);
    }

    public function show(string $code)
    {
        return Ticket::all();
        return new TicketResource(Ticket::whereCode($code)->firstOrFail());
    }
}
