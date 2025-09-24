<?php
use App\Http\Controllers\ActorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('actors', ActorController::class);
Route::resource('films', FilmController::class);

use App\Http\Controllers\RentalController;


Route::get('rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('rentals/create', [RentalController::class, 'create'])->name('rentals.create');
Route::post('rentals', [RentalController::class, 'store'])->name('rentals.store');
Route::get('rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show');
Route::get('rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('rentals/create', [RentalController::class, 'create'])->name('rentals.create');
Route::post('rentals', [RentalController::class, 'store'])->name('rentals.store');
Route::get('rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show');
Route::get('rentals/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
Route::put('rentals/{rental}', [RentalController::class, 'update'])->name('rentals.update');
Route::delete('rentals/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');
Route::post('rentals/{rental}/return', [RentalController::class, 'return'])->name('rentals.return');
