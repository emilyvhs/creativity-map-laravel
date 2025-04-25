<?php

use App\Http\Controllers\ApproveController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SuccessController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GroupController::class, 'search']);

Route::get('groups/add', [GroupController::class, 'displayAddForm']);
Route::post('groups/add', [GroupController::class, 'create']);

Route::get('groups', [GroupController::class, 'all']);
Route::get('groups/{id}', [GroupController::class, 'find']);

Route::get('map', [MapController::class, 'getCoordinates']);

Route::get('success', [SuccessController::class, 'display']);

Route::get('approve', [ApproveController::class, 'all']);
Route::get('approve/{id}', [ApproveController::class, 'find']);
Route::get('approved/{id}', [ApproveController::class, 'approve']);
Route::get('deleted/{id}', [ApproveController::class, 'delete']);

Route::get('approve/edit/{id}', [GroupController::class, 'displayEditForm']);
Route::patch('approve/edit/{id}', [GroupController::class, 'update']);
