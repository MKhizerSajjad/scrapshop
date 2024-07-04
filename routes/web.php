<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LorryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;

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
Route::get('/register', function () {
    return redirect()->route('login');
});
// Route::redirect()->route('register', 'login');
// Route::redirect('/register', '/login');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('lorry', LorryController::class)->names('lorry');
    Route::resource('purchase', PurchaseController::class)->names('purchase');
    Route::resource('sale', SaleController::class)->names('sale');
    Route::resource('data', DataController::class)->names('data');
    Route::resource('contacts', ContactsController::class)->names('contacts');
    Route::resource('packages', ContactsController::class)->names('packages');
    Route::get('contacts-export', [DataController::class, 'export'])->name('data.export');
    Route::post('contacts-import', [DataController::class, 'import'])->name('data.import');
});
