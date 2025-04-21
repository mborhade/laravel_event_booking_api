<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_event(): void
    {
        $data = [
            'title' => 'Tech Summit',
            'description' => 'Annual tech conference.',
            'location' => 'USA',
            'date' => now()->addDays(2)->toDateTimeString(),
            'capacity' => 100,
        ];

        $response = $this->postJson('/api/events', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Tech Summit']);
    }

    public function test_can_list_events(): void
    {
        Event::factory()->count(3)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }
}
