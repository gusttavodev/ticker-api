<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use App\Models\Prize;
use App\Models\Ticket;
use App\Actions\MakePrize;

class TicketControllerStoreTest extends TestCase
{
    /** @test */
    public function it_should_be_create_ticket_with_success()
    {
        $data = $this->getData();

        $response = ($this->postJson(route('ticket.store'), $data));

        $response->assertJson([
            'ticketCode' => Ticket::first()->code
        ]);
    }

    /** @test
        * @dataProvider getRequiredFields
        *
        * @var string $field
    */
    public function it_should_be_validate_ticket_required_fields($field)
    {
        $data = $this->getData([
            $field => null,
        ]);

        $response = $this->post(route('ticket.store'), $data);
        $response->assertSessionHasErrors(
            $field,
            __('validation.required', [
                'attribute' => $field,
            ])
        );
    }

    /** @test */
    public function it_should_be_validate_ticket_array_field()
    {
        $data = $this->getData([
            'numbers' => '123'
        ]);

        $response = $this->post(route('ticket.store'), $data);

        $response->assertSessionHasErrors(
            'numbers',
            __('validation.array', [
                'attribute' => 'numbers',
            ])
        );
    }

    public function getRequiredFields(): array
    {
        return [
            ['name'],
            ['numbers']
        ];
    }

    private function getData(array $newData = []):array
    {
        $defaultData = [
            'name' => 'Peter Test',
            'numbers'       => [1,2,3,4,5,6]
        ];

        return array_merge($defaultData, $newData);
    }
}
