<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Attendee;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $event = Event::findOrFail($validated['event_id']);
        $attendee = Attendee::findOrFail($validated['attendee_id']);

        // Check capacity
        if ($event->bookings()->count() >= $event->capacity) {
            return response()->json(['message' => 'Event is fully booked.'], 400);
        }

        // Prevent duplicate booking
        if (Booking::where('event_id', $event->id)->where('attendee_id', $attendee->id)->exists()) {
            return response()->json(['message' => 'Attendee already booked this event.'], 400);
        }

        $booking = Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        return response()->json($booking, 201);
    }
}
