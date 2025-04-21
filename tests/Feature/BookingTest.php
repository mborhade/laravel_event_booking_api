<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Booking;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_book_event(): void
    {
        $event = Event::factory()->create(['capacity' => 2]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['event_id' => $event->id]);
    }

    public function test_prevent_duplicate_booking(): void
    {
        $event = Event::factory()->create();
        $attendee = Attendee::factory()->create();

        Booking::create(['event_id' => $event->id, 'attendee_id' => $attendee->id]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(400)
                 ->assertJsonFragment(['message' => 'Attendee already booked this event.']);
    }

    public function test_prevent_overbooking(): void
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        Booking::create(['event_id' => $event->id, 'attendee_id' => $attendee1->id]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee2->id,
        ]);

        $response->assertStatus(400)
                 ->assertJsonFragment(['message' => 'Event is fully booked.']);
    }
}
