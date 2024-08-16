<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Cinema;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $cinema->rooms;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validar los datos de la solicitud
       $request->validate([
        'cinema_id' => 'required|exists:cinemas,id', // Asegurarse de que el cinema_id sea válido
        'room_number' => 'required|unique:rooms',
        'total_seats' => 'required|integer',
        'movie_title' => 'required|string',
    ]);

    // Recuperar el cine usando el cinema_id proporcionado en el cuerpo de la solicitud
    $cinema = Cinema::find($request->cinema_id);

    if (!$cinema) {
        return response()->json(['error' => 'Cinema not found'], 404);
    }

    // Crear una nueva habitación y asociarla con el cine
    $room = new Room([
        'cinema_id' => $cinema->id, // Asociar la habitación con el cinema_id
        'room_number' => $request->room_number,
        'total_seats' => $request->total_seats,
        'available_seats' => $request->total_seats, // Inicialmente, todos los asientos están disponibles
        'movie_title' => $request->movie_title,
    ]);

    $room->save();

    return response()->json($room, 201);

   }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $room;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room->update($request->all());
        return response()->json($room, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room->delete();
        return response()->json(null, 204);
    }
}
