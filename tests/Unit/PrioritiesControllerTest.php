<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Priorities;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrioritiesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_priority()
    {
        $response = $this->postJson('/api/priorities', [
            'namepriority' => 'Alta Prioridad',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'priority' => [
                         'id',
                         'namepriority',
                         'created_at',
                         'updated_at',
                     ],
                 ]);

        $this->assertDatabaseHas('priorities', [
            'namepriority' => 'Alta Prioridad',
        ]);
    }

    /** @test */
    public function it_can_update_a_priority()
    {
        $priority = Priorities::factory()->create();

        $response = $this->putJson('/api/priorities/' . $priority->id, [
            'namepriority' => 'Prioridad Actualizada',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Prioridad actualizada correctamente']);

        $this->assertDatabaseHas('priorities', [
            'id' => $priority->id,
            'namepriority' => 'Prioridad Actualizada',
        ]);
    }

    /** @test */
    public function it_can_delete_a_priority()
    {
        $priority = Priorities::factory()->create();

        $response = $this->deleteJson('/api/priorities/' . $priority->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Prioridad eliminada correctamente']);

        $this->assertDatabaseMissing('priorities', [
            'id' => $priority->id,
        ]);
    }

    /** @test */
    public function it_can_get_a_single_priority()
    {
        $priority = Priorities::factory()->create();

        $response = $this->getJson('/api/priorities/' . $priority->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'priority' => [
                         'id',
                         'namepriority',
                         'created_at',
                         'updated_at',
                     ],
                 ]);
    }

    /** @test */
    public function it_can_get_all_priorities()
    {
        Priorities::factory()->count(5)->create();

        $response = $this->getJson('/api/priorities');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'priorities' => [
                         '*' => [
                             'id',
                             'namepriority',
                             'created_at',
                             'updated_at',
                         ],
                     ],
                 ]);
    }
}
