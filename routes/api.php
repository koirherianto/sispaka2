<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::resource('projects', App\Http\Controllers\API\ProjectAPIController::class)
    ->except(['create', 'edit']);

Route::resource('methods', App\Http\Controllers\API\MethodAPIController::class)
    ->except(['create', 'edit']);

Route::resource('backward-chainings', App\Http\Controllers\API\BackwardChainingAPIController::class)
    ->except(['create', 'edit']);

Route::resource('bc-facts', App\Http\Controllers\API\BcFactAPIController::class)
    ->except(['create', 'edit']);