<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movie.show');
