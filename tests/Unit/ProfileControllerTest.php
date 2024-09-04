<?php

namespace Tests\Unit;
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Profiles;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_profile()
    {
        $response = $this->postJson('/api/profiles', [
            'name' => 'Perfil de prueba',
            'image' => 'imagen.png',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'profile' => [
                         'id',
                         'name',
                         'image',
                         'created_at',
                         'updated_at',
                     ]
                 ]);

        $this->assertDatabaseHas('profiles', [
            'name' => 'Perfil de prueba',
        ]);
    }

    /** @test */
    public function it_can_update_a_profile()
    {
        $profile = Profiles::factory()->create();

        $response = $this->putJson('/api/profiles/' . $profile->id, [
            'name' => 'Perfil actualizado',
            'image' => 'imagen_actualizada.png',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Perfil actualizado correctamente']);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'name' => 'Perfil actualizado',
        ]);
    }
