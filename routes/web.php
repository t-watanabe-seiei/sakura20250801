<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubtractionProblemController;
use App\Http\Controllers\AdvancedSubtractionProblemController;

Route::get('/', [SubtractionProblemController::class, 'show'])->name('subtraction.show');
Route::post('/answer', [SubtractionProblemController::class, 'answer'])->name('subtraction.answer');
Route::get('/history', [SubtractionProblemController::class, 'history'])->name('subtraction.history');
Route::post('/history/reset', [SubtractionProblemController::class, 'resetHistory'])->name('subtraction.reset');

// Advanced (11-19から1-9を引く) ルート
Route::get('/advanced', [AdvancedSubtractionProblemController::class, 'show'])->name('advanced.show');
Route::post('/advanced/answer', [AdvancedSubtractionProblemController::class, 'answer'])->name('advanced.answer');
Route::get('/advanced/history', [AdvancedSubtractionProblemController::class, 'history'])->name('advanced.history');
Route::post('/advanced/history/reset', [AdvancedSubtractionProblemController::class, 'resetHistory'])->name('advanced.reset');
