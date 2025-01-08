<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transportation;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $transportations = Transportation::all();
        return view('admin.dashboard', ['transportations' => $transportations]);
    }
}

