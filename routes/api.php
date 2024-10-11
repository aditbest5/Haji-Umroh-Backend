<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\PilgrimController;
use App\Models\Pilgrim;
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
Route::group([
    "prefix"=>"auth",   
], function(){
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);
    Route::post("logout", [AuthController::class, "logout"])->middleware('auth');
    Route::post("role", [AuthController::class, "insert_role"]);
});

Route::group([
    "prefix"=> "data",
    'middleware' => 'auth.jwt',
], function(){
    Route::resource("pilgrim", PilgrimController::class);
});