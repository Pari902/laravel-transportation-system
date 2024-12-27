<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TransportationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController; // Import the RecordController

// Authentication Routes
Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware(['auth']);
 // User registration
Route::post('login', [AuthController::class, 'login']);       // User login

// Protected Transportation Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/transportations', [TransportationController::class, 'index']); // List all transportations
    Route::post('/transportations', [TransportationController::class, 'store']); // Add a transportation
    Route::get('/transportations/{id}', [TransportationController::class, 'show']); // View details of one
    Route::put('/transportations/{id}', [TransportationController::class, 'update']); // Update transportation
    Route::delete('/transportations/{id}', [TransportationController::class, 'destroy']); // Delete transportation
});

// Route for creating a record
Route::post('/records', [RecordController::class, 'store']);
Route::get('/records', [RecordController::class, 'index']);


