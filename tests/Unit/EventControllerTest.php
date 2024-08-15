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
            'location' => 'Lugar de prueba',
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

    /** @test */
    public function it_can_update_an_event()
    {
        $event = Event::factory()->create();

        $response = $this->putJson('/api/events/' . $event->id, [
            'name' => 'Evento actualizado',
            'description' => 'Descripción actualizada',
            'date' => '2024-08-25',
            'location' => 'Lugar actualizado',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Evento actualizado correctamente']);

        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'name' => 'Evento actualizado',
        ]);
    }

    /** @test */
    public function it_can_delete_an_event()
    {
        $event = Event::factory()->create();

        $response = $this->deleteJson('/api/events/' . $event->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Evento eliminado correctamente']);

        $this->assertDatabaseMissing('events', [
            'id' => $event->id,
        ]);
    }

    /** @test */
    public function it_can_get_a_single_event()
    {
        $event = Event::factory()->create();

        $response = $this->getJson('/api/events/' . $event->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
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
    }

}
