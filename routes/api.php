<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TransportationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']); // User registration
Route::post('/login', [AuthController::class, 'login']);       // User login

// Protected Transportation Routes for Admin
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/transportations', [TransportationController::class, 'index'])->name('transportation.index');       // List all transportations
    Route::post('/transportations', [TransportationController::class, 'store'])->name('transportation.store');      // Add a transportation
    Route::get('/transportations/{id}', [TransportationController::class, 'show'])->name('transportation.show');    // View details of one
    Route::put('/transportations/{id}', [TransportationController::class, 'update'])->name('transportation.update');// Update transportation
    Route::delete('/transportations/{id}', [TransportationController::class, 'destroy'])->name('transportation.destroy'); // Delete transportation
});

// General Record Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/records', [RecordController::class, 'store'])->name('record.store'); // Create a record
    Route::get('/records', [RecordController::class, 'index'])->name('record.index');  // Get all records
});






