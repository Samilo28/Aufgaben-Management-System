<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;
use App\Models\Aufgabe;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AufgabenTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function createTaskTest()
    {
        $user = User::factory()->create();

        $payload = [
            'title' => 'Test Aufgabe',
            'description' => 'Test Beschreibung',
            'status' => 'todo',
        ];

        $response = $this->actingAs($user)->postJson('/api/aufgaben', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('aufgaben', [
            'title' => 'Test Aufgabe',
            'description' => 'Test Beschreibung',
            'status' => 'todo',
            'user_id' => $user->id,
        ]);
    }

    #[Test] public function updateTaskTest()
    {
        $user = User::factory()->create();

        $aufgabe = Aufgabe::factory()->for($user)->create([
            'title' => 'Test Titel',
            'description' => 'Test Beschreibung',
            'status' => 'todo',
        ]);

        $payload = [
            'title' => 'Aktualisierter Test Titel',
            'description' => 'Aktualisierte Test Beschreibung',
            'status' => 'in_progress'
        ];

        $response = $this->actingAs($user)->putJson("/api/aufgaben/{$aufgabe->id}", $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('aufgaben', [
            'id' => $aufgabe->id,
            'title' => 'Aktualisierter Test Titel',
            'description' => 'Aktualisierte Test Beschreibung',
            'status' => 'in_progress',
        ]);
    }

    #[Test] public function deleteTaskTest()
    {
        $user = User::factory()->create();

        $aufgabe = Aufgabe::factory()->for($user)->create([
            'title' => 'Test Aufgabe',
            'description' => 'Test Beschreibung',
            'status' => 'todo',
        ]);

        $response = $this->actingAs($user)
            ->deleteJson("/api/aufgaben/{$aufgabe->id}");

        $response->assertNoContent(); // 204

        $this->assertDatabaseMissing('aufgaben', [
            'id' => $aufgabe->id,
        ]);
    }
}
