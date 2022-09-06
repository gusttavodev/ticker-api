<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-ticket', [TicketController::class, 'store'])->name('ticket.store');
Route::get('/ticket/{code}', [TicketController::class, 'show'])->name('ticket.show');
