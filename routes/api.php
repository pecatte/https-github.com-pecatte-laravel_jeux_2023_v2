<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;


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

Route::get('/', function () {
    return "hello";
});

Route::get('jeux', [JeuController::class, 'list']);

Route::post('jeux', [JeuController::class, 'add']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});