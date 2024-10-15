<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tasks;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_tasks()
    {
        // Crea algunas tareas para la prueba
        Tasks::factory()->count(3)->create();

        // Realiza una solicitud GET a la ruta tasks.index
        $response = $this->getJson(route('tasks.index'));

        // Verifica que la respuesta sea un 200 OK y contenga las tareas
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    // Resto de las pruebas...
}
