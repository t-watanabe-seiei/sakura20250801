<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubtractionProblemController;

Route::get('/', [SubtractionProblemController::class, 'show'])->name('subtraction.show');
Route::post('/answer', [SubtractionProblemController::class, 'answer'])->name('subtraction.answer');
Route::get('/history', [SubtractionProblemController::class, 'history'])->name('subtraction.history');
