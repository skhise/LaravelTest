<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SessionTimeout;

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

Route::get('/', [UserController::class,'index']);

Route::middleware([SessionTimeout::class])->group(function(){
    Route::get('/home', [UserController::class,'home']);
    Route::post('checklogin', [UserController::class,'checklogin']);
    Route::get('successlogin', [UserController::class,'successlogin']);
    Route::get('logout', [UserController::class,'Logout']);
});
