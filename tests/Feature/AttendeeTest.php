<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_attendee(): void
    {
        $data = ['name' => 'John Doe', 'email' => 'john@example.com'];

        $response = $this->postJson('/api/attendees', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'john@example.com']);
    }

    public function test_attendee_email_validation(): void
    {
        $data = ['name' => 'John Doe', 'email' => 'not-an-email'];

        $response = $this->postJson('/api/attendees', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }
}
