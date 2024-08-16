<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class NotesControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function test_index()
    {
        // Arrange: Create a few notes
        Note::factory()->count(5)->create();

        // Act: Make a GET request to the index route
        $response = $this->get('/notes');

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    /**
     * Test the store method.
     *
     * @return void
     */
    public function test_store()
    {
        // Arrange: Prepare the data to be sent in the request
        $data = [
            'title' => 'New Note',
            'content' => 'This is a test note.',
        ];

        // Act: Make a POST request to the store route
        $response = $this->post('/notes', $data);

        // Assert: Check if the note was created and the response is correct
        $response->assertStatus(201);
        $this->assertDatabaseHas('notes', $data);
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function test_update()
    {
        // Arrange: Create a note and prepare updated data
        $note = Note::factory()->create();
        $data = [
            'title' => 'Updated Note',
            'content' => 'This note has been updated.',
        ];

        // Act: Make a PUT request to the update route
        $response = $this->put("/notes/{$note->id}", $data);

        // Assert: Check if the note was updated and the response is correct
        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', $data);
    }

    /**
     * Test the destroy method.
     *
     * @return void
     */
    public function test_destroy()
    {
        // Arrange: Create a note
        $note = Note::factory()->create();

        // Act: Make a DELETE request to the destroy route
        $response = $this->delete("/notes/{$note->id}");

        // Assert: Check if the note was deleted
        $response->assertStatus(200);
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
