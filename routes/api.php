<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TransportationController;

Route::middleware([])->group(function () {
    Route::get('/transportations', [TransportationController::class, 'index']); // List all transportations
    Route::post('/transportations', [TransportationController::class, 'store']); // Add a transportation
    Route::get('/transportations/{id}', [TransportationController::class, 'show']); // View details of one
    Route::put('/transportations/{id}', [TransportationController::class, 'update']); // Update transportation
    Route::delete('/transportations/{id}', [TransportationController::class, 'destroy']); // Delete transportation
});