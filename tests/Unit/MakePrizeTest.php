<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Prize;
use App\Models\Ticket;
use App\Actions\MakePrize;

class MakePrizeTest extends TestCase
{
    protected array $winnerNumbers = [1,2,3,4,5,6];
    protected Prize $prize;

    public function setUp() : void
    {
        parent::setUp();
        $this->prize = Prize::factory()->create([
            'numbers' => $this->winnerNumbers
        ]);
    }

    /** @test */
    public function it_should_be_make_prize_set_winner_and_lose_ticket()
    {
        $ticketWinner =  Ticket::factory()->create([
            'numbers' => $this->winnerNumbers,
            'winner' => false,
            'created_at' => $this->prize->created_at->subSecond(15)
        ]);

        $ticketLose =  Ticket::factory()->create([
            'numbers' => [1, 2, 4, 4, 5, 6],
            'winner' => false,
            'created_at' => $this->prize->created_at->subSecond(15)
        ]);

        MakePrize::execute($this->prize);

        $this->assertTrue($ticketWinner->refresh()->winner);
        $this->assertFalse($ticketLose->refresh()->winner);
        $this->assertEquals($ticketWinner->refresh()->prize_id, $this->prize->id);
        $this->assertEquals($ticketLose->refresh()->prize_id, $this->prize->id);
    }
}
