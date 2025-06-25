<?php

use Illuminate\Support\Facades\Route;

// Simple test route to verify Laravel is working
Route::get('/', function () {
    return 'Laravel is working on Railway!';
})->name('home.test');

// Test database connection
Route::get('/test-db', function () {
    try {
        $cars = \App\Models\Car::count();
        return "Database connected! Found {$cars} cars.";
    } catch (\Exception $e) {
        return "Database error: " . $e->getMessage();
    }
});

// Test view rendering
Route::get('/test-view', function () {
    return view('welcome'); // Uses Laravel's default welcome view
});
