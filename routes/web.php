<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Equipments\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
// ---- app routes ----
Route::get('/',[HomeController::class,'index'])->name("home")->middleware('auth');
// ---- Profile routes ----
Route::get('/profile',[HomeController::class,'profile'])->name("profile")->middleware('auth');
Route::get('/editProfile',[HomeController::class,'EditProfile'])->name("EditProfile")->middleware('auth');
Route::post('/editProfile',[UserController::class,'edit'])->name("EditProfile")->middleware('auth');
Route::post("/deleteUser",[UserController::class,'delete'])->name("deleteUser")->middleware('auth');
// ---- equipment routes ----
Route::post('/add',[EquipmentController::class,"add"])->name("add")->middleware('auth');
Route::post('/edit',[EquipmentController::class,"edit"])->name("edit")->middleware('auth');
Route::get('/delete/{id}',[EquipmentController::class,"delete"])->name("delete")->middleware('auth');
route::get('/identifyLostEquipment/{id}',[EquipmentController::class,"identifyLostEquipment"])->name("identifyLostEquipment");
// ---- Auth routes (GET) ----
Route::get("/register",[HomeController::class,'register'])->name("register");
Route::get("/login",[HomeController::class,'login'])->name("login");
Route::get("/logout",[AuthController::class,'logout'])->name("logout");
// ---- Auth routes (POST) ----
Route::post("/register",[AuthController::class,'register'])->name("register");
Route::post("/login",[AuthController::class,'login'])->name("login");
// ---- test routes ----
Route::get('/test',[HomeController::class,'test'])->name("test");
// ---- QR code routes ----
Route::get('qrcode/{id}', function ($id) {
     $url = route('identifyLostEquipment', ['id' => $id]);
     return QrCode::format('png')->size(400)->generate($url);
})->name('qrcode');