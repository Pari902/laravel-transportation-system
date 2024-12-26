<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportation;

class TransportationController extends Controller
{
    // Fetch all transportations
    public function index()
    {
        $transportations = Transportation::all();
        return response()->json(['data' => $transportations], 200);
    }

    // Add a new transportation
    public function store(Request $request)
    {
        $validatedData = $this->validateTransportation($request);

        $transportation = Transportation::create($validatedData);

        return response()->json([
            'message' => 'Transportation created successfully.',
            'data' => $transportation,
        ], 201);
    }

    // Get a specific transportation
    public function show($id)
    {
        $transportation = Transportation::findOrFail($id);

        return response()->json(['data' => $transportation], 200);
    }

    // Update transportation details
    public function update(Request $request, $id)
    {
        $transportation = Transportation::findOrFail($id);

        $validatedData = $this->validateTransportation($request, $id);

        $transportation->update($validatedData);

        return response()->json([
            'message' => 'Transportation updated successfully.',
            'data' => $transportation,
        ], 200);
    }

    // Delete a transportation
    public function destroy($id)
    {
        $transportation = Transportation::findOrFail($id);
        $transportation->delete();

        return response()->json([
            'message' => 'Transportation deleted successfully.',
        ], 204);
    }

    // Reusable validation rules
    private function validateTransportation(Request $request, $id = null)
    {
        $uniqueVehicleNumber = $id 
            ? 'unique:transportations,vehicle_number,' . $id 
            : 'unique:transportations';

        return $request->validate([
            'vehicle_number' => ['required', 'string', $uniqueVehicleNumber],
            'type' => ['required', 'string'],
            'capacity' => ['required', 'integer'],
            'route' => ['required', 'string'],
            'status' => ['required', 'in:Active,Inactive'],
        ]);
    }
}



