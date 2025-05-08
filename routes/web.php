<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('home');
});

Route::get('/notes/index', NoteController::class . '@index')->name('notes.index');
Route::get('/notes/trashed', NoteController::class . '@trashed')->name('notes.trashed')->middleware(['auth']);
Route::put('/notes/trashed/{id}', NoteController::class . '@restore')->name('notes.restore')->middleware(['auth']);
Route::get('/notes/show/{id}', NoteController::class . '@show')->name('notes.show');
Route::get('notes/create', NoteController::class .'@create')->name('notes.create')->middleware(['auth']);
Route::post('notes', NoteController::class .'@store')->name('notes.store')->middleware(['auth']);
Route::get('notes/edit/{id}', NoteController::class .'@edit')->name('notes.edit')->middleware(['auth']);
Route::put('notes/{id}', NoteController::class .'@update')->name('notes.update')->middleware(['auth']);
Route::delete('notes/{id}', NoteController::class .'@destroy')->name('notes.destroy')->middleware(['auth']);
Route::get('notes/search', NoteController::class .'@search')->name('notes.search')->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

