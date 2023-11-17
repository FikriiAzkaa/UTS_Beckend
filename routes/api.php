<?php

use App\Models\Digital;
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
// HRD

Route::middleware(['auth:sanctum'])->group(function () {
    // membuat route dengan method get all News
    Route::get('/news', [DigitalController::class,'index']);

    // membuat route dengan method post  
    Route::post('/news', [DigitalController::class,'store']);

    // membuat route dengan method put
    Route::put('/news/{id}', [DigitalController::class,'update']);

    // membuat route dengan method delete
    Route::delete('/news/{id}', [DigitalController::class,'destroy']);

    // mendapatkan detail News
    Route::get('/news/{id}', [DigitalController::class,'show']);

});

// route untuk login dan register
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
