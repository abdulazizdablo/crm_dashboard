<?php

use App\Http\Controllers\AuthinticationController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthinticationController::class, 'register']);

    Route::get('/login', [AuthinticationController::class, 'login']);
});




Route::resource('project', [ProjectController::class]);
Route::resource('task', [TaskController::class]);
Route::resource('client', [clientController::class]);
