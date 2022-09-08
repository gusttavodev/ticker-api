<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use App\Models\Prize;
use App\Models\Ticket;
use App\Actions\MakePrize;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\TicketResource;

class TicketControllerShowTest extends TestCase
{
    protected array $winnerNumbers = [1,2,3,4,5,6];
    protected Prize $prize;
    protected Ticket $winnerTicket;
    protected Ticket $loseTicket;

    public function setUp() : void
    {
        parent::setUp();
        Carbon::setTestNow();

        $this->prize = Prize::factory()->create([
            'numbers' => $this->winnerNumbers,
            'created_at' => Carbon::now()
        ]);
        $this->winnerTicket = Ticket::factory()->create([
            'numbers' => $this->winnerNumbers,
            'created_at' => Carbon::now()->subSeconds(10)
        ]);
        $this->loseTicket = Ticket::factory()->create([
            'numbers' => [1,2,2,4,5,6],
            'created_at' => Carbon::now()->subSeconds(15)
        ]);
    }

    /** @test */
    public function it_should_be_show_ticket_with_success()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->getJson(route('ticket.show', $ticket->code));
        $response->assertResource(new TicketResource($ticket));
    }

    /** @test */
    public function it_should_be_show_ticket_winner_post_prize()
    {
        MakePrize::execute($this->prize);

        $response = $this->getJson(route('ticket.show', $this->winnerTicket->code));
        $data = $response->getData(true)['data'];

        $this->assertTrue($data['winner']);
        $this->assertEquals($data['message'], 'winner');
        $this->assertEquals($data['machineNumbers'], $this->winnerNumbers);
    }

    /** @test */
    public function it_should_be_show_ticket_lose_post_prize()
    {
        MakePrize::execute($this->prize);

        $response = $this->getJson(route('ticket.show', $this->loseTicket->code));
        $data = $response->getData(true)['data'];

        $this->assertFalse($data['winner']);
        $this->assertEquals($data['message'], 'lose');
        $this->assertEquals($data['machineNumbers'], $this->winnerNumbers);
    }
}
