<?php

use App\Http\Controllers\AuthinticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
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

/*Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthinticationController::class, 'register']);

    Route::get('/login', [AuthinticationController::class, 'login']);
});*/







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('media', [MediaController::class, 'createImage'])->name('media.createImage');
    Route::post('media', [MediaController::class, 'updateImage'])->name('media.updateImage');

    Route::get('users', [UserController::class, 'delete'])->name('users.delete')->middleware('role:admin');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


    Route::post('projects/{project}', [ProjectController::class, 'softDelete'])->name('projects.soft-delete');
    Route::post('tasks/{task}', [TaskController::class, 'softDelete'])->name('tasks.soft-delete');
    Route::post('users/{user}', [UserController::class, 'softDelete'])->name('users.soft-delete');
    Route::post('clients/{client}', [ClientController::class, 'softDelete'])->name('clients.soft-delete');


    Route::get('active-users', [UserController::class, 'activeUsers'])->name('users.active');
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('clients', ClientController::class);
});
