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

Route::middleware(['auth:sanctum'])
    ->prefix('user')
    ->group(function () {
        //로그인 검증 - 가지고 있는 토큰이 없거나, 유효하지 않는 경우 신규 토큰 만듦
        Route::post('', [AuthenticateFirstLoginController::class, 'login']);
    });
