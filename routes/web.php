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

Route::post("/summernote/image", [App\Http\Controllers\WebApiController::class, 'summernoteImageUpload']);

Route::prefix("/")->middleware([App\Http\Middleware\UserLang::class,])->name("web.public.")->group(function () {

    Route::get("/", [App\Http\Controllers\IndexController::class, 'index'])->name("index");

    Route::get("/courses", [App\Http\Controllers\IndexController::class, 'courseIndex'])->name("course.index");
    Route::get("/contact", [App\Http\Controllers\IndexController::class, 'contactIndex'])->name("contact.index");
    Route::get("/about", [App\Http\Controllers\IndexController::class, 'aboutIndex'])->name("about.index");
    Route::get("/faq", [App\Http\Controllers\IndexController::class, 'faqIndex'])->name("faq.index");
    Route::get("/privacy", [App\Http\Controllers\IndexController::class, 'privacyIndex'])->name("privacy.index");
    Route::get("/terms", [App\Http\Controllers\IndexController::class, 'termsIndex'])->name("terms.index");

    Route::prefix("/engine")->name("api.")->group(function () {
      #  Route::post("/subscribe", [App\Http\Controllers\WebApiController::class, 'subscribe'])->name("subscribe");
        Route::post("/message/send", [App\Http\Controllers\WebApiController::class, 'sendMessage'])->name("message.send");
    });

    Route::get('account',function(){
        return route('web.account.index');
    })->name("account.index");


    /**
     * .ROOT
     */
});

Route::any('/test', [App\Http\Controllers\TestController::class, 'test']);
