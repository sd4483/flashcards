<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\GroupComponent;
use App\Http\Livewire\FlashCardComponent;
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
    if (Auth::check()) {
        return view('cards');
    } else {
        return view('welcome');
    }
});

Route::get('/cards', function () {
    return view('cards');
})->middleware('auth')->name('cards');


//Route::get('/welcome', FlashCardComponent::class)->name('welcome');

Route::get('/groups', GroupComponent::class)->name('groups');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
