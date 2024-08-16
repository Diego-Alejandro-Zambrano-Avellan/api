<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function availableSeats(Room $room)
    {
        return response()->json(['available_seats' => $room->available_seats], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $seatsToReserve = $request->input('number_of_seats');

        if ($seatsToReserve > $room->available_seats) {
            return response()->json(['message' => 'Not enough seats available'], 400);
        }

        $room->available_seats -= $seatsToReserve;
        $room->save();

        $reservation = Reservation::create([
            'room_id' => $room->id,
            'number_of_seats' => $seatsToReserve,
        ]);

        return response()->json($reservation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function reserve(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'room_id' => 'required|exists:rooms,id', // Asegurarse de que el room_id sea válido
            'seats_to_reserve' => 'required|integer|min:1', // Asegúrate de que la reserva sea un número válido de asientos
        ]);

        // Recuperar la habitación usando el room_id proporcionado en el cuerpo de la solicitud
        $room = Room::find($request->room_id);

        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        // Verificar si hay suficientes asientos disponibles
        if ($request->seats_to_reserve > $room->available_seats) {
            return response()->json(['error' => 'Not enough available seats'], 400);
        }

        // Reservar los asientos
        $room->available_seats -= $request->seats_to_reserve;
        $room->save();

        return response()->json([
            'message' => 'Seats reserved successfully',
            'reserved_seats' => $request->seats_to_reserve,
            'remaining_seats' => $room->available_seats
        ], 200);
    }
}
