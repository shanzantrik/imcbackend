<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\ComplaintsController;
use App\Http\Controllers\Firebase\CompostController;
use App\Http\Controllers\Firebase\GarbagesController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Complaint Routes
Route::middleware('auth')->group( callback: function () {
    Route::get('complaints', [ComplaintsController::class, 'index'])->name('complaints-index');
    Route::get('add-complaints', [ComplaintsController::class, 'create'])->name('add-complaints');
    Route::post('add-complaints', [ComplaintsController::class, 'store'])->name('save-complaints');
    Route::get('edit-complaints/{id}', [ComplaintsController::class, 'edit'])->name('edit-complaints');
    Route::put('update-complaints/{id}', [ComplaintsController::class, 'update'])->name('update-complaints');

    // Route::delete('delete-complaints/{id}', [ComplaintsController::class, 'destroy'])->name('delete-complaints');
});

//CompostController Routes
Route::middleware('auth')->group( callback: function () {
    Route::get('composts', [CompostController::class, 'index'])->name('composts-index');
    Route::get('add-composts', [CompostController::class, 'create'])->name('add-composts');
    Route::post('add-composts', [CompostController::class, 'store'])->name('save-composts');
});
//Garbages Routes
Route::middleware('auth')->group( callback: function () {
    Route::get('garbages', [GarbagesController::class, 'index'])->name('garbages-index');
    Route::get('add-garbages', [GarbagesController::class, 'create'])->name('add-garbages');
    Route::post('add-garbages', [GarbagesController::class, 'store'])->name('save-garbages');
    // Route::get('edit-garbages/{id}', [GarbagesController::class, 'edit'])->name('edit-garbages');
    // Route::put('update-garbages/{id}', [GarbagesController::class, 'update'])->name('update-garbages');

    // Route::delete('delete-garbages/{id}', [ComplaintsController::class, 'destroy'])->name('delete-garbages');
});
