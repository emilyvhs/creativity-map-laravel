<?php

use App\Http\Controllers\ApproveController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PendingGroupController;
use App\Http\Controllers\SuccessController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GroupController::class, 'search']);

Route::get('groups/add', [PendingGroupController::class, 'addForm']);
Route::post('groups/add', [PendingGroupController::class, 'create']);

Route::get('groups', [GroupController::class, 'all']);
Route::get('groups/{id}', [GroupController::class, 'find']);

Route::get('map', [MapController::class, 'getCoordinates']);

Route::get('success', [SuccessController::class, 'display']);

Route::get('approve', [ApproveController::class, 'all']);
Route::get('approve/{id}', [ApproveController::class, 'find']);

Route::get('approve/edit/{id}', [PendingGroupController::class, 'editForm']);
Route::patch('approve/edit/{id}', [PendingGroupController::class, 'update']);
