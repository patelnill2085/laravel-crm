<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

// Redirect home to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
require __DIR__.'/auth.php';

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Profile Routes - yeh add karo
    Route::get('/profile', function() {
        return view('profile.edit');
    })->name('profile.edit');

    Route::patch('/profile', function() {
        return redirect()->route('dashboard');
    })->name('profile.update');

    Route::delete('/profile', function() {
        return redirect()->route('login');
    })->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customers
    Route::resource('customers', CustomerController::class)
        ->middleware('role:admin,manager');

    // Leads Kanban
    Route::get('/leads/kanban', [LeadController::class, 'kanban'])->name('leads.kanban');
    Route::patch('/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.updateStatus');
    // Leads
    Route::resource('leads', LeadController::class);


});