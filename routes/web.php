<?php

use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\QueryDataController;
use App\Http\Controllers\Backend\QueryPageController;
use App\Http\Controllers\Backend\TripHomeController;
use App\Http\Controllers\Backend\TripSaveController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/** ADMIN ROUTES */
Route::group(['as'=>'admin.','prefix'=>'/admin','middleware'=>'auth'],function(){

    Route::get('/trips',TripHomeController::class)->name('trips');
    Route::resource('/trip',TripSaveController::class);
    Route::get('/dashboard',DashboardController::class)->name('dashboard');
    Route::get('/query',QueryPageController::class)->name('query');
    Route::resource('queries',QueryDataController::class);
});

require __DIR__.'/auth.php';
