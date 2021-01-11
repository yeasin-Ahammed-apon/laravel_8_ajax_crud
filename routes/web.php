<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\live;

Route::get('/',[live::class, 'home']);
Route::post('/add',[live::class, 'add']);
Route::delete('/delete/{id}',[live::class, 'delete']);
Route::get('/view/{id}',[live::class, 'view']);
Route::post('/edit',[live::class, 'edit']);
Route::get('/one',[live::class, 'one']);


