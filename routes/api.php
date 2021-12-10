<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\EquipmentTypes\ApiEquipmentTypesController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\EquipmentStatuses\ApiEquipmentStatusesController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravolt\Avatar\Avatar;

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

// ---- user routes ----
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/user/profileImage', function (Request $request) {
    $user = $request->user();
    $avatar = new Avatar();
     return $avatar->create($user->name)->setDimension(300)->setFontSize(75)->toBase64();
});
Route::middleware('auth:sanctum')->post('/user/edit', [ApiUserController::class, 'edit']);
Route::middleware('auth:sanctum')->delete('/user/delete', [ApiUserController::class, 'delete']);
// ---- equipment related routes ----
Route::middleware('auth:sanctum')->get('/user/equipments', [ApiController::class, 'getUserEquipment']);
Route::middleware('auth:sanctum')->get('/user/equipmentByID/{id}', [ApiController::class, 'getUserEquipmentByID']);
Route::middleware('auth:sanctum')->post('/user/createEquipment', [ApiController::class, 'setUserEquipment']);
Route::middleware('auth:sanctum')->post('/user/updateEquipment/{id}', [ApiController::class, 'updateUserEquipment']);
Route::middleware('auth:sanctum')->delete('/user/deleteEquipment/{id}', [ApiController::class, 'deleteUserEquipment']);
Route::middleware('auth:sanctum')->get('/user/transferEquipment/{token}', [ApiController::class, 'transferEquipment']);
Route::middleware('auth:sanctum')->get('/user/getTransferToken/{id}', [ApiController::class, 'getTransferToken']);
//---- general routes needed from the api ----
Route::middleware('auth:sanctum')->get('/user/image/{id}', [ApiController::class, 'getUserEquipmentImage']);
Route::middleware('auth:sanctum')->get('/equipmentTypes', [ApiEquipmentTypesController::class, 'getAllEquipmentTypes']);
Route::middleware('auth:sanctum')->get('/equipmentStatuses', [ApiEquipmentStatusesController::class, 'getAllEquipmentStatuses']);
// ---- api auth routes ----
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']);

Route::get('/test', function (Request $request) {
    $user = User::with(['user_status'])->where('id',$request->user()->id)->first();
    return $user;
})->middleware('auth:sanctum');
