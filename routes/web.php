<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TasksController;

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

Auth::routes();
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/tasks', [TasksController::class, 'index']);
Route::get('/tasks/list', [TasksController::class, 'getList']);
Route::post('/tasks/store', [TasksController::class, 'store']);
Route::put('/tasks/update/{id}', [TasksController::class, 'update']);
Route::get('/tasks/view/{id}', [TasksController::class, 'view']);
Route::delete('/tasks/destroy/{id}', [TasksController::class, 'destroy']);
Route::post('/tasks/get-task', [TasksController::class, 'getTask']);
