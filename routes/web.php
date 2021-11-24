<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Equipments\EquipmentController;
use App\Http\Controllers\HomeController;
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
Route::post('/add',[EquipmentController::class,"add"])->name("add")->middleware('auth');
Route::post('/edit',[EquipmentController::class,"edit"])->name("edit")->middleware('auth');
// ---- Auth routes (GET) ----
Route::get("/register",[HomeController::class,'register'])->name("register");
Route::get("/login",[HomeController::class,'login'])->name("login");
Route::get("/logout",[AuthController::class,'logout'])->name("logout");
// ---- Auth routes (POST) ----
Route::post("/register",[AuthController::class,'register'])->name("register");
Route::post("/login",[AuthController::class,'login'])->name("login");
// ---- test routes ----
Route::get('/test',[HomeController::class,'test'])->name("test")->middleware('auth');

