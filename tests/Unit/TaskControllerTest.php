<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tasks;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_task()
    {
        $response = $this->postJson('/api/tasks', [
            'name' => 'Tarea de prueba',
            'description' => 'Descripción de prueba',
            'priorityid' => 1,
            'duedate' => '2024-08-20',
            'timeestimatehours' => 4,
            'profileid' => 1,
            'statusid' => 1,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id',
                     'name',
                     'description',
                     'priorityid',
                     'duedate',
                     'timeestimatehours',
                     'profileid',
                     'statusid',
                     'created_at',
                     'updated_at',
                 ]);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Tarea de prueba',
        ]);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->putJson('/api/tasks/' . $task->id, [
            'name' => 'Tarea actualizada',
            'description' => 'Descripción actualizada',
            'priorityid' => 2,
            'duedate' => '2024-08-25',
            'timeestimatehours' => 6,
            'profileid' => 1,
            'statusid' => 2,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Tarea actualizada']);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Tarea actualizada',
        ]);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->deleteJson('/api/tasks/' . $task->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Task deleted successfully']);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    /** @test */
    public function it_can_get_a_single_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->getJson('/api/tasks/' . $task->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'name',
                     'description',
                     'priorityid',
                     'duedate',
                     'timeestimatehours',
                     'profileid',
                     'statusid',
                     'created_at',
                     'updated_at',
                 ]);
    }

    /** @test */
    public function it_can_get_all_tasks()
    {
        Tasks::factory()->count(5)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'name',
                         'description',
                         'priorityid',
                         'duedate',
                         'timeestimatehours',
                         'profileid',
                         'statusid',
                         'created_at',
                         'updated_at',
                     ]
                 ]);
    }
}

