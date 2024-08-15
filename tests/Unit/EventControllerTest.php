<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_event()
    {
        $response = $this->postJson('/api/events', [
            'name' => 'Evento de prueba',
            'description' => 'Descripción de prueba',
            'date' => '2024-08-20',
            'location' => 'Ubicación de prueba',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'event' => [
                         'id',
                         'name',
                         'description',
                         'date',
                         'location',
                         'created_at',
                         'updated_at',
                     ]
                 ]);

        $this->assertDatabaseHas('events', [
            'name' => 'Evento de prueba',
        ]);
    }

}
