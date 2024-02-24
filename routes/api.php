<?php

use App\Http\Controllers\Authorization\AuthenticateFirstLoginController;
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

Route::prefix('user')
    ->group(function () {
        //로그인 검증
        Route::post('login', [AuthenticateFirstLoginController::class, 'login']);
    });



