<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CharacterController::class, 'index'])->name('characters.index');
Route::get('/character/{id}', [CharacterController::class, 'show'])->name('characters.show');
