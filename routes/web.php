<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controller\PassportAuthController;
use App\Http\Controller\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('register/' , [PassportAuthController::class , 'register']);
Route::post('login/' , [PassportAuthController::class , 'login']);



Route::middleware(['auth:api'])->group(function ()
{
    Route::get('userInfo/' , [PassportAuthController::class , 'userInfo']);
      Route::resource('products/' , PassportAuthController::class);
});

