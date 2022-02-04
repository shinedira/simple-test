<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::resource('candidate', CandidateController::class)
    ->except('show')
    ->middleware('auth:api');