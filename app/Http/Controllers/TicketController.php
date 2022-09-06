<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\TickerResource;
use App\Http\Requests\Ticket\StoreRequest;

class TicketController extends Controller
{
    public function store(StoreRequest $request)
    {
        $inputs = $request->validated();

        $ticket = new Ticket(array_merge(['code' => Str::uuid()], $inputs));

        return response()->json(['ticketCode' => $ticket->code]);
    }

    public function show(string $code)
    {
        return new TickerResource(Ticket::whereCode($code)->first());
    }
}
