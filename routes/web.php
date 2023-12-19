<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix("/")->middleware([App\Http\Middleware\UserLang::class,])->name("web.public.")->group(function () {

    Route::get("/", [App\Http\Controllers\IndexController::class, 'index'])->name("index");

    Route::get("/contact", [App\Http\Controllers\IndexController::class, 'contactIndex'])->name("contact.index");
    Route::get("/about", [App\Http\Controllers\IndexController::class, 'aboutIndex'])->name("about.index");


    /**
     * .ROOT
     */
});

Route::any('/test', [App\Http\Controllers\TestController::class, 'test']);
