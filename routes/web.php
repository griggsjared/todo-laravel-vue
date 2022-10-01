<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoToggleCompleteController;
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

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('todos', TodoController::class)->only(['store', 'update', 'destroy']);
Route::put('todos/{todo}/toggle-complete', TodoToggleCompleteController::class)->name('todos.toggle-complete');

Route::resource('categories', CategoryController::class)->only(['store', 'update', 'destroy']);
