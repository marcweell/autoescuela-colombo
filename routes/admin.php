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



Route::prefix("/admin/account")->name("web.admin.account.")->middleware([])->group(function () {

    Route::get("/", function () {
        return redirect()->route("web.app.index");
    })->name("index");


    Route::get("/logout", [App\Http\Controllers\AdminUi\AuthController::class, 'logout'])->name("auth.logout");
    Route::post("/logout", [App\Http\Controllers\AdminUi\AuthController::class, 'postLogout'])->name("auth.logout.post");


    Route::prefix("/auth")->name("auth.")->middleware(App\Http\Middleware\WebAdminNotValidSession::class)->group(function () {
        Route::get("/", [App\Http\Controllers\AdminUi\AuthController::class, 'loginIndex'])->name("index");
        Route::post("/", [App\Http\Controllers\AdminUi\AuthController::class, 'login'])->name("login");
        Route::post("/reauth", [App\Http\Controllers\AdminUi\AuthController::class, 'reAuth'])->name("reAuth");
    });
    Route::prefix("/oauth")->name("oauth.")->middleware(App\Http\Middleware\WebAdminNotValidSession::class)->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\AuthController::class, 'oauthIndex'])->name("index");
        Route::post("/auth", [App\Http\Controllers\AdminUi\AuthController::class, 'oauth'])->name("auth");
    });
    Route::prefix("/activation")->name("activation.")->middleware(App\Http\Middleware\WebAdminNotValidSession::class)->group(function () {
        Route::get("/", [App\Http\Controllers\AdminUi\AuthController::class, 'activationIndex'])->name("index");
        Route::post("/auth", [App\Http\Controllers\AdminUi\AuthController::class, 'activate'])->name("auth");
        Route::get("/otp", [App\Http\Controllers\AdminUi\AuthController::class, 'otpIndex'])->name("otp.index");
        Route::post("/otp/auth", [App\Http\Controllers\AdminUi\AuthController::class, 'otpAuth'])->name("otp.auth");
    });
    Route::prefix("/forgot")->name("forgot.")->middleware(App\Http\Middleware\WebAdminNotValidSession::class)->group(function () {
        Route::get("/", [App\Http\Controllers\AdminUi\AuthController::class, 'forgotIndex'])->name("index");
        Route::post("/auth", [App\Http\Controllers\AdminUi\AuthController::class, 'forgot'])->name("auth");
    });
});



Route::prefix("/admin")->name("web.admin.")->middleware([App\Http\Middleware\WebAdminValidSession::class,])->group(function () {
    Route::get("/", [App\Http\Controllers\AdminUi\IndexController::class, 'index'])->middleware([])->name('index');
    Route::post("/", [App\Http\Controllers\AdminUi\IndexController::class, 'postIndex'])->middleware([])->name('postIndex');


    #---------------------------------------------------------------------------------------------------------------



    Route::prefix("/profile")->middleware([])->name("profile.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\AccountController::class, 'index'])->middleware([])->name("index");

        Route::prefix("/password")->middleware([])->name("password.update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Password_changeController::class, 'changeIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\Password_changeController::class, 'change'])->middleware([])->name("do");
        });
        Route::prefix("/settings")->middleware([])->name("update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\AccountController::class, 'updateIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\AccountController::class, 'update'])->middleware([])->name("do");
        });
        Route::prefix("/remove")->middleware([])->name("remove.")->group(function () {

            Route::post("/do", [App\Http\Controllers\AdminUi\AccountController::class, 'remove'])->middleware([])->name("do");
        });
        Route::post("/change_picture", [App\Http\Controllers\AdminUi\AccountController::class, 'change_picture'])->middleware([])->name("change_picture");

    });



    #---------------------------------------------------------------------------------------------------------------


    Route::prefix("/admins")->middleware([])->name("admin.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\AdminController::class, 'index'])->middleware([])->name("index");
        Route::prefix("/add")->middleware([])->name("add.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\AdminController::class, 'addIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\AdminController::class, 'add'])->middleware([])->name("do");
        });
        Route::prefix("/update")->middleware([])->name("update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\AdminController::class, 'updateIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\AdminController::class, 'update'])->middleware([])->name("do");
        });

        Route::prefix("/detail")->middleware([])->name("detail.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\AdminController::class, 'detailIndex'])->middleware([])->name("index");
        });
        Route::prefix("/remove")->middleware([])->name("remove.")->group(function () {

            Route::post("/do", [App\Http\Controllers\AdminUi\AdminController::class, 'remove'])->middleware([])->name("do");
        });

        #----------------------------------------------

    });


    #---------------------------------------------------------------------------------------------------------------


    Route::prefix("/user")->middleware([])->name("user.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\UserController::class, 'index'])->middleware([])->name("index");
        Route::prefix("/add")->middleware([])->name("add.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\UserController::class, 'addIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'add'])->middleware([])->name("do");
        });
        Route::prefix("/update")->middleware([])->name("update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\UserController::class, 'updateIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'update'])->middleware([])->name("do");
        });
        Route::prefix("/remove")->middleware([])->name("remove.")->group(function () {

            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'remove'])->middleware([])->name("do");
        });

        #----------------------------------------------

    });


    /**
     * .ADMIN
     */

    Route::get('/{url}', [App\Http\Controllers\AdminUi\IndexController::class, 'index'])->middleware([])->where('url', '.*');
});
