<?php

namespace Tests\Feature;

use App\Models\Reminder;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReminderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to create a new reminder.
     *
     * @return void
     */
    public function test_create_reminder()
    {
        // Crea un perfil de prueba para asociarlo al reminder
        $profile = Profile::factory()->create();

        // Datos del recordatorio
        $data = [
            'description' => 'Reminder description',
            'alarm' => 1,
            'datereminder' => now()->addDay()->format('Y-m-d'),
            'hourreminder' => now()->addHour()->format('H:i:s'),
            'profileid' => $profile->id,
        ];

        // Realiza la petición para crear el reminder
        $response = $this->postJson('/reminders', $data);

        // Asegúrate de que el reminder se haya creado correctamente
        $response->assertStatus(201)
                 ->assertJsonFragment(['description' => 'Reminder description']);
                 
        // Verifica que el recordatorio esté en la base de datos
        $this->assertDatabaseHas('reminders', ['description' => 'Reminder description']);
    }

    /**
     * Test to retrieve a specific reminder.
     *
     * @return void
     */
    public function test_show_reminder()
    {
        // Crea un recordatorio de prueba
        $reminder = Reminder::factory()->create();

        // Realiza la petición para obtener el reminder
        $response = $this->getJson('/reminders/' . $reminder->id);

        // Asegúrate de que el reminder se haya obtenido correctamente
        $response->assertStatus(200)
                 ->assertJsonFragment(['description' => $reminder->description]);
    }

    /**
     * Test to update a reminder.
     *
     * @return void
     */
    public function test_update_reminder()
    {
        // Crea un recordatorio de prueba
        $reminder = Reminder::factory()->create();

        // Datos actualizados para el reminder
        $updatedData = [
            'description' => 'Updated reminder description',
            'alarm' => 0,
        ];

        // Realiza la petición para actualizar el reminder
        $response = $this->putJson('/reminders/' . $reminder->id, $updatedData);

        // Asegúrate de que el reminder se haya actualizado correctamente
        $response->assertStatus(200)
                 ->assertJsonFragment(['description' => 'Updated reminder description']);
        
        // Verifica que el recordatorio actualizado esté en la base de datos
        $this->assertDatabaseHas('reminders', ['description' => 'Updated reminder description']);
    }

    /**
     * Test to delete a reminder.
     *
     * @return void
     */
    public function test_delete_reminder()
    {
        // Crea un recordatorio de prueba
        $reminder = Reminder::factory()->create();

        // Realiza la petición para eliminar el reminder
        $response = $this->deleteJson('/reminders/' . $reminder->id);

        // Asegúrate de que el reminder se haya eliminado correctamente
        $response->assertStatus(204);

        // Verifica que el recordatorio haya sido eliminado de la base de datos
        $this->assertDatabaseMissing('reminders', ['id' => $reminder->id]);
    }
}
