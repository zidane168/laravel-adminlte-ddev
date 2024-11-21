<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);

// multiple language
Route::get('lang/{locale}', function ($locale) { 

    if (in_array($locale, config('app.locales'))) {
       //  App::setlocale($locale);
        
    // print_r($locale);
    // exit;
        session(['locale' => $locale]); 
    } 
    return redirect()->back(); 
})->name('setLocale');

 