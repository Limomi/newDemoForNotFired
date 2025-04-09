<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('dashboard');
// }) -> name('/');

Route::get('/', [WorkController::class, 'adminIndex']) -> name('/');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/work', [WorkController::class, 'create'])->name('work.create');
    Route::post('/work/post', [WorkController::class, 'store'])->name('work.store');

    Route::post('/work/update', [WorkController::class, 'update'])->name('work.update');
});

require __DIR__.'/auth.php';
