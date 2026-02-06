<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Place;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/places', function () {return view('places.places');})->name('places');
    Route::get('/place/add', function () {return view('places.add_new');})->name('places.add');

    Route::get('/items', function () {return view('dashboard');})->name('items');
    Route::get('/item/add', function () {return view('add_new_item');})->name('item.add');

    Route::get('/users', function () {return view('users.users');})->name('users');
    Route::get('/users/add', function () {return view('users.add_new');})->name('users.add');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
