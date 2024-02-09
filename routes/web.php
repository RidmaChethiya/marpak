<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', HomeController::class .'@index')->name('home');
Route::post('/generate_pdf', HomeController::class .'@generatePdf')->name('generate_pdf');

Route::get('/menu', MenuController::class .'@index')->name('menu');

Route::resource('/code', CodeController::class);

Route::resource('/color', ColorController::class);

Route::resource('/size', SizeController::class);

Route::resource('/attribute', AttributeController::class);




