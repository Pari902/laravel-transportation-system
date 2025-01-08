<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportation;

class TransportationController extends Controller
{
    // Fetch all transportations (API)
    public function index()
    {
        $transportations = Transportation::all();
        return response()->json(['data' => $transportations], 200);
    }

    // Add a new transportation (API)
    public function store(Request $request)
    {
        $validatedData = $this->validateTransportation($request);

        $transportation = Transportation::create($validatedData);

        return response()->json([
            'message' => 'Transportation created successfully.',
            'data' => $transportation,
        ], 201);
    }

    // Get a specific transportation (API)
    public function show($id)
    {
        $transportation = Transportation::findOrFail($id);

        return response()->json(['data' => $transportation], 200);
    }

    // Update transportation details (API)
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

    // Delete a transportation (API)
    public function destroy($id)
    {
        $transportation = Transportation::findOrFail($id);
        $transportation->delete();

        return response()->json([
            'message' => 'Transportation deleted successfully.',
        ], 204);
    }

    // Reusable validation rules for API
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

    // ==================
    // Admin Dashboard Functions
    // ==================

    // View all transportations for Admin
    public function adminIndex()
    {
        $transportations = Transportation::all();
        return view('admin.dashboard', compact('transportations'));
    }

    // Add a new transportation via Admin Dashboard
    public function adminStore(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_number' => 'required|string|unique:transportations',
            'type' => 'required|string',
            'capacity' => 'required|integer',
            'route' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        Transportation::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Transportation added successfully!');
    }

    // Edit a transportation via Admin Dashboard
    public function adminEdit($id)
    {
        $transportation = Transportation::findOrFail($id);
        return view('admin.edit', compact('transportation'));
    }

    // Update a transportation via Admin Dashboard
    public function adminUpdate(Request $request, $id)
    {
        $transportation = Transportation::findOrFail($id);

        $validatedData = $request->validate([
            'vehicle_number' => 'required|string|unique:transportations,vehicle_number,' . $id,
            'type' => 'required|string',
            'capacity' => 'required|integer',
            'route' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $transportation->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Transportation updated successfully!');
    }

    // Delete a transportation via Admin Dashboard
    public function adminDestroy($id)
    {
        $transportation = Transportation::findOrFail($id);
        $transportation->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Transportation deleted successfully!');
    }
}




