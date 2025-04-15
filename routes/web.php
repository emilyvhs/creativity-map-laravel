<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GroupController::class, 'search']);
Route::get('groups', [GroupController::class, 'all']);
Route::get('groups/{id}', [GroupController::class, 'find']);

Route::get('map', [MapController::class, 'getCoordinates']);
