<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstructeurController;
use App\Http\Controllers\VoertuigController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('instructeurs.index');
});

// Instructeur routes
Route::get('/instructeurs', [InstructeurController::class, 'index'])->name('instructeurs.index');
Route::get('/instructeurs/{id}', [InstructeurController::class, 'show'])->name('instructeurs.show');

// Voertuig routes
Route::get('/voertuigen', [VoertuigController::class, 'index'])->name('voertuigen.index');
Route::get('/instructeurs/{id}/voertuigen', [VoertuigController::class, 'getVoertuigenByInstructeur'])->name('instructeur.voertuigen');
Route::get('/voertuigen/{id}/edit', [VoertuigController::class, 'edit'])->name('voertuigen.edit');
Route::put('/voertuigen/{id}', [VoertuigController::class, 'update'])->name('voertuigen.update');
