<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $bookings = Booking::with(['client', 'room'])->latest()->paginate(100);

        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $isBooked = Booking::where('room_id', $validatedData['room_id'])
            ->where(function ($query) use ($validatedData) {
                $query->where('start_date', '<', $validatedData['end_date'])
                    ->where('end_date', '>', $validatedData['start_date']);
            })->exists();

        if ($isBooked) {
            return response()->json(['message' => 'На данный промежуток времени номер уже забронирован.'], 409);
        }

        $room = Room::findOrFail($validatedData['room_id']);
        $startDate = Carbon::parse($validatedData['start_date']);
        $endDate = Carbon::parse($validatedData['end_date']);

        $days = $startDate->diffInDays($endDate);
        $totalPrice = $days * $room->price_per_night;

        $booking = new Booking($validatedData);
        $booking->total_price = $totalPrice;
        $booking->save();

        $booking->load(['client', 'room']);

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): JsonResponse
    {
        $booking->load(['client', 'room']);

        return response()->json($booking);
    }
}
