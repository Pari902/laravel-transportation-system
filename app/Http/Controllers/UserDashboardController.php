<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportation;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Fetch transportation data from the database
        $transportations = Transportation::all();

        // Pass the data to the Vue frontend
        return response()->json($transportations);
    }
}



