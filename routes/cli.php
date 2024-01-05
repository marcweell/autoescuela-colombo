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



Route::prefix("/cli")->name("web.crm.")->middleware([App\Http\Middleware\MyCompany::class])->group(function () {


    Route::prefix("/project")->name("project.")->group(function () {

        Route::prefix("/survey_answer")->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("survey_answer.")->group(function () {
            Route::post("/", [App\Http\Controllers\CrmUi\Survey_answerController::class, 'index'])->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\CrmUi\Survey_answerController::class, 'addIndex'])->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("index");
                Route::post("/do", [App\Http\Controllers\CrmUi\Survey_answerController::class, 'add'])->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\CrmUi\Survey_answerController::class, 'updateIndex'])->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("index");
                Route::post("/do", [App\Http\Controllers\CrmUi\Survey_answerController::class, 'update'])->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("remove.")->group(function () {
                Route::post("/", [App\Http\Controllers\CrmUi\Survey_answerController::class, 'removeIndex'])->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("index");
                Route::post("/do", [App\Http\Controllers\CrmUi\Survey_answerController::class, 'remove'])->middleware([App\Http\Middleware\DevAccess::class, App\Http\Middleware\Police::class])->name("do");
            });
        });

        Route::prefix("/survey")->name("survey.")->group(function () {
            Route::post("/inquire/{comp}/{permalink}", [App\Http\Controllers\CrmUi\SurveyController::class, 'addAnswerIndex'])->name("index");
        });
    });



    #-----------------------------------------------------------------------------------------------------------------------------------------

    Route::post("/", [App\Http\Controllers\CrmUi\IndexController::class, 'mainIndex'])->name('index');
    Route::get("/", [App\Http\Controllers\CrmUi\IndexController::class, 'index'])->name('index');
    Route::get('/{url}', [App\Http\Controllers\CrmUi\IndexController::class, 'index'])->where('url', '.*');
});
