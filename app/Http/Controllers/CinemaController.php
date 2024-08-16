<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;
class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cinema::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cinema = Cinema::create($request->all());
        return response()->json($cinema, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $cinema;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cinema->update($request->all());
        return response()->json($cinema, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cinema->delete();
        return response()->json(null, 204);
    }
}
