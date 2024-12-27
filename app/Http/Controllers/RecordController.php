<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Record; // Import the Record model

class RecordController extends Controller
{
    /**
     * Store a new record in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new record and save it in the database
        $record = Record::create([
            'name' => $request->name,
        ]);

        // Return a success response with the created record
        return response()->json([
            'success' => true,
            'data' => $record,
        ]);
    }

    public function index()
    {
        $records = Record::all();
        return response()->json(['success' => true, 'data' => $records]);
    }

}

