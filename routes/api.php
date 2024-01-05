<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::name('api.')->group(function(){


    Route::prefix("/company")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("company.")->group(function () {
        Route::prefix("/")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("company.")->group(function () {
            Route::get("/", [App\Http\Controllers\Api\CompanyController::class, 'index'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::get("/add", [App\Http\Controllers\Api\CompanyController::class, 'add'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("add");
            Route::get("/detail", [App\Http\Controllers\Api\CompanyController::class, 'detailIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("detail");
            Route::get("/delete", [App\Http\Controllers\Api\CompanyController::class, 'remove'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("delete");
           
            Route::prefix("/update")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\CompanyController::class, 'updateIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\CompanyController::class, 'update'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
        });
    
    
        Route::prefix("/category")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("company_category.")->group(function () {
            Route::post("/", [App\Http\Controllers\Api\Company_categoryController::class, 'index'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::prefix("/add")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Company_categoryController::class, 'addIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Company_categoryController::class, 'add'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/update")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Company_categoryController::class, 'updateIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Company_categoryController::class, 'update'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/remove")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("remove.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Company_categoryController::class, 'removeIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Company_categoryController::class, 'remove'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/detail")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Company_categoryController::class, 'detailIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            });
        });
    
        Route::prefix("/business_area")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("business_area.")->group(function () {
            Route::post("/", [App\Http\Controllers\Api\Business_areaController::class, 'index'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::prefix("/add")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Business_areaController::class, 'addIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Business_areaController::class, 'add'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/update")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Business_areaController::class, 'updateIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Business_areaController::class, 'update'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/remove")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("remove.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Business_areaController::class, 'removeIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Business_areaController::class, 'remove'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/detail")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Business_areaController::class, 'detailIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            });
        });
    
        Route::prefix("/service_type")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("service_type.")->group(function () {
            Route::post("/", [App\Http\Controllers\Api\Service_typeController::class, 'index'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::prefix("/add")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Service_typeController::class, 'addIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Service_typeController::class, 'add'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/update")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Service_typeController::class, 'updateIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Service_typeController::class, 'update'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/remove")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("remove.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Service_typeController::class, 'removeIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Service_typeController::class, 'remove'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/detail")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Service_typeController::class, 'detailIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            });
        });
    
        Route::prefix("/event_category")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("event_category.")->group(function () {
            Route::post("/", [App\Http\Controllers\Api\Event_categoryController::class, 'index'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::prefix("/add")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Event_categoryController::class, 'addIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Event_categoryController::class, 'add'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/update")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Event_categoryController::class, 'updateIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Event_categoryController::class, 'update'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/remove")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("remove.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Event_categoryController::class, 'removeIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\Event_categoryController::class, 'remove'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/detail")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\Event_categoryController::class, 'detailIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            });
        });
    
    
        Route::prefix("/department")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("department.")->group(function () {
            Route::post("/", [App\Http\Controllers\Api\DepartmentController::class, 'index'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::prefix("/add")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\DepartmentController::class, 'addIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\DepartmentController::class, 'add'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/update")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\DepartmentController::class, 'updateIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\DepartmentController::class, 'update'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/remove")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("remove.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\DepartmentController::class, 'removeIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\DepartmentController::class, 'remove'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
            Route::prefix("/detail")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\DepartmentController::class, 'detailIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            });
        });
    
    
        Route::prefix("/statistics")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("statistics.")->group(function () {
            Route::post("/", [App\Http\Controllers\Api\CompanyController::class, 'statisticsIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::prefix("/report")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("report.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\CompanyController::class, 'statistisRepostIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/download", [App\Http\Controllers\Api\CompanyController::class, 'statisticsReportDownload'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("download");
            });
        });
    
        Route::prefix("/settings")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("settings.")->group(function () {
            Route::post("/", [App\Http\Controllers\Api\CompanyController::class, 'settingsIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
            Route::prefix("/update")/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\Api\CompanyController::class, 'settingsUpdateIndex'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("index");
                Route::post("/do", [App\Http\Controllers\Api\CompanyController::class, 'settingsUpdate'])/*->middleware\(\[App\Http\Middleware\Police::class\]\)*/->name("do");
            });
        });
    });
    



});