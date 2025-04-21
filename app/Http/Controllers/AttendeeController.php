<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendeeRequest;
use App\Models\Attendee;
use Illuminate\Http\JsonResponse;

class AttendeeController extends Controller
{
    public function store(StoreAttendeeRequest $request): JsonResponse
    {
        $attendee = Attendee::create($request->validated());
        return response()->json($attendee, 201);
    }

    public function show(Attendee $attendee): JsonResponse
    {
        return response()->json($attendee);
    }
}
