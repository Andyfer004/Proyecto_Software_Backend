<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Subtask;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubtasksControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_subtask()
    {
        $response = $this->postJson('/api/subtasks', [
            'name' => 'Subtarea de prueba',
            'description' => 'Descripción de prueba',
            'priorityid' => 1,
            'duedate' => '2024-08-20',
            'timeestimatehours' => 4,
            'taskid' => 1,
            'statusid' => 1,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'subtask' => [
                         'id',
                         'name',
                         'description',
                         'priorityid',
                         'duedate',
                         'timeestimatehours',
                         'taskid',
                         'statusid',
                         'created_at',
                         'updated_at',
                     ]
                 ]);

        $this->assertDatabaseHas('subtasks', [
            'name' => 'Subtarea de prueba',
        ]);
    }

    /** @test */
    public function it_can_update_a_subtask()
    {
        $subtask = Subtask::factory()->create();

        $response = $this->putJson('/api/subtasks/' . $subtask->id, [
            'name' => 'Subtarea actualizada',
            'description' => 'Descripción actualizada',
            'priorityid' => 2,
            'duedate' => '2024-08-25',
            'timeestimatehours' => 6,
            'taskid' => 1,
            'statusid' => 2,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Subtarea actualizada correctamente']);

        $this->assertDatabaseHas('subtasks', [
            'id' => $subtask->id,
            'name' => 'Subtarea actualizada',
        ]);
    }

    /** @test */
    public function it_can_delete_a_subtask()
    {
        $subtask = Subtask::factory()->create();

        $response = $this->deleteJson('/api/subtasks/' . $subtask->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Subtarea eliminada correctamente']);

        $this->assertDatabaseMissing('subtasks', [
            'id' => $subtask->id,
        ]);
    }

    /** @test */
    public function it_can_get_a_single_subtask()
    {
        $subtask = Subtask::factory()->create();

        $response = $this->getJson('/api/subtasks/' . $subtask->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'subtask' => [
                         'id',
                         'name',
                         'description',
                         'priorityid',
                         'duedate',
                         'timeestimatehours',
                         'taskid',
                         'statusid',
                         'created_at',
                         'updated_at',
                     ]
                 ]);
    }

    /** @test */
    public function it_can_get_all_subtasks()
    {
        Subtask::factory()->count(5)->create();

        $response = $this->getJson('/api/subtasks');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'subtasks' => [
                         '*' => [
                             'id',
                             'name',
                             'description',
                             'priorityid',
                             'duedate',
                             'timeestimatehours',
                             'taskid',
                             'statusid',
                             'created_at',
                             'updated_at',
                         ]
                     ]
                 ]);
    }
}
