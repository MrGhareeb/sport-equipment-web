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
// ---- user related routes ----
Route::middleware('auth:sanctum')->get('/user/equipments', [ApiController::class, 'getUserEquipment']);
Route::middleware('auth:sanctum')->get('/user/equipmentByID/{id}', [ApiController::class, 'getUserEquipmentByID']);
Route::middleware('auth:sanctum')->post('/user/createEquipment', [ApiController::class, 'setUserEquipment']);
Route::middleware('auth:sanctum')->post('/user/updateEquipment/{id}', [ApiController::class, 'updateUserEquipment']);
Route::middleware('auth:sanctum')->get('/user/deleteEquipment/{id}', [ApiController::class, 'deleteUserEquipment']);
//---- general routes needed from the api ----
Route::middleware('auth:sanctum')->get('/user/image/{id}', [ApiController::class, 'getUserEquipmentImage']);
Route::middleware('auth:sanctum')->get('/equipmentTypes', [ApiEquipmentTypesController::class, 'getAllEquipmentTypes']);
Route::middleware('auth:sanctum')->get('/equipmentStatuses', [ApiEquipmentStatusesController::class, 'getAllEquipmentStatuses']);
// ---- api auth routes ----
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']);
