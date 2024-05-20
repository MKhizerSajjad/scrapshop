<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ContactsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('data', DataController::class)->names('data');
    Route::resource('contacts', ContactsController::class)->names('contacts');
    Route::resource('packages', ContactsController::class)->names('packages');
    Route::get('contacts-export', [DataController::class, 'export'])->name('data.export');
    Route::post('contacts-import', [DataController::class, 'import'])->name('data.import');
});
