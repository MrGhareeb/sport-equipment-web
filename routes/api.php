<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\EquipmentTypes\ApiEquipmentTypesController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\EquipmentStatuses\ApiEquipmentStatusesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

    // ---- api routes ----
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('auth:sanctum')->get('/user/Equipments', [ApiController::class, 'getUserEquipment']);
    Route::middleware('auth:sanctum')->get('/user/EquipmentByID/{id}', [ApiController::class, 'getUserEquipmentByID']);
    Route::middleware('auth:sanctum')->post('/user/createEquipment', [ApiController::class, 'setUserEquipment']);

    Route::middleware('auth:sanctum')->get('/user/Image/{id}', [ApiController::class, 'getUserEquipmentImage']);
    //
    Route::middleware('auth:sanctum')->get('/EquipmentTypes', [ApiEquipmentTypesController::class, 'getAllEquipmentTypes']);
    Route::middleware('auth:sanctum')->get('/EquipmentStatuses', [ApiEquipmentStatusesController::class, 'getAllEquipmentStatuses']);


    // ---- api auth routes ----
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']);

