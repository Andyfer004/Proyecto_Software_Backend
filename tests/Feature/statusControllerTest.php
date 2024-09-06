<?php
##TESTING STATUS CONTROLLER
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Status;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_status()
    {
        $response = $this->postJson('/status', [
            'statusname' => 'Activo',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Estado creado correctamente',
                     'status' => [
                         'statusname' => 'Activo'
                     ]
                 ]);

        $this->assertDatabaseHas('status', [
            'statusname' => 'Activo'
        ]);
    }

    public function test_get_all_statuses()
    {
        $response = $this->getJson('/statuses');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'statuses' => [
                         '*' => ['id', 'statusname', 'created_at', 'updated_at']
                     ]
                 ]);
    }

    public function test_get_status_by_id()
    {
        $status = Status::factory()->create();

        $response = $this->getJson('/status/' . $status->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => [
                         'id' => $status->id,
                         'statusname' => $status->statusname
                     ]
                 ]);
    }

    public function test_update_status()
    {
        $status = Status::factory()->create();

        $response = $this->putJson('/status/' . $status->id, [
            'statusname' => 'Inactivo'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Estado actualizado correctamente',
                     'status' => [
                         'statusname' => 'Inactivo'
                     ]
                 ]);

        $this->assertDatabaseHas('status', [
            'id' => $status->id,
            'statusname' => 'Inactivo'
        ]);
    }

    public function test_delete_status()
    {
        $status = Status::factory()->create();

        $response = $this->deleteJson('/status/' . $status->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Estado eliminado correctamente'
                 ]);

        $this->assertDatabaseMissing('status', [
            'id' => $status->id
        ]);
    }
}
