<?php

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GroupController::class, 'search']);
Route::get('groups', [GroupController::class, 'all']);
Route::get('groups/{id}', [GroupController::class, 'find']);
