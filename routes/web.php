<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PendingGroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GroupController::class, 'search']);
Route::get('groups', [GroupController::class, 'all']);

Route::get('groups/add', [PendingGroupController::class, 'addGroup']);
Route::post('groups/add', [PendingGroupController::class, 'create']);

Route::get('groups/{id}', [GroupController::class, 'find']);

Route::get('map', [MapController::class, 'getCoordinates']);
