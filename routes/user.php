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


Route::prefix("/account")->middleware([App\Http\Middleware\UserLang::class, ])->name("web.account.")->group(function () {

    Route::get("/", function () {
        return redirect()->route("web.admin.index");
    })->middleware(App\Http\Middleware\WebUserValidSession::class)->name("index");


    Route::get("/logout", [App\Http\Controllers\UserUi\AuthController::class, 'logout'])->name("auth.logout");
    Route::post("/logout", [App\Http\Controllers\UserUi\AuthController::class, 'postLogout'])->name("auth.logout.post");
    Route::prefix("/auth")->name("auth.")->middleware(App\Http\Middleware\WebUserNotValidSession::class)->group(function () {
        Route::get("/", [App\Http\Controllers\UserUi\AuthController::class, 'loginIndex'])->name("index");
        Route::post("/", [App\Http\Controllers\UserUi\AuthController::class, 'login'])->name("login");
        Route::post("/reauth", [App\Http\Controllers\UserUi\AuthController::class, 'reAuth'])->name("reAuth");
    });
    Route::prefix("/signup")->name("signup.")->middleware(App\Http\Middleware\WebUserNotValidSession::class)->group(function () {
        Route::get("/", [App\Http\Controllers\UserUi\AuthController::class, 'signupIndex'])->name("index");
        Route::post("/do", [App\Http\Controllers\UserUi\AuthController::class, 'signup'])->name("do");
    });
    Route::prefix("/activation")->name("activation.")->middleware(App\Http\Middleware\WebUserNotValidSession::class)->group(function () {
        Route::get("/", [App\Http\Controllers\UserUi\AuthController::class, 'activationIndex'])->name("index");
        Route::post("/auth", [App\Http\Controllers\UserUi\AuthController::class, 'activate'])->name("auth");
        Route::get("/otp", [App\Http\Controllers\UserUi\AuthController::class, 'otpIndex'])->name("otp.index");
        Route::post("/otp/auth", [App\Http\Controllers\UserUi\AuthController::class, 'otpAuth'])->name("otp.auth");
    });
    Route::prefix("/forgot")->name("forgot.")->middleware(App\Http\Middleware\WebUserNotValidSession::class)->group(function () {
        Route::get("/", [App\Http\Controllers\UserUi\AuthController::class, 'forgotIndex'])->name("index");
        Route::post("/auth", [App\Http\Controllers\UserUi\AuthController::class, 'forgot'])->name("auth");
    });
});


Route::prefix("/")->name("web.")->group(function () {
    Route::prefix("/dashboard")->name("app.")->middleware([App\Http\Middleware\WebUserValidSession::class,  App\Http\Middleware\UserLang::class])->group(function () {
        Route::get("/", [App\Http\Controllers\UserUi\IndexController::class, 'index'])->name('index');
        Route::post("/", [App\Http\Controllers\UserUi\IndexController::class, 'postIndex'])->name('postIndex');
        Route::post("/tutorial", [App\Http\Controllers\UserUi\IndexController::class, 'tutorialIndex'])->name('tutorial.index');

        Route::prefix("/engine")->name("api.")->group(function () {
            Route::get("/user", [App\Http\Controllers\WebApiController::class, 'listUser'])->name("user");
        });


        Route::prefix("/profile")->name("profile.")->group(function () {
            Route::post("/", [App\Http\Controllers\UserUi\AccountController::class, 'index'])->name("index");

            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\UserUi\AccountController::class, 'updateIndex'])->name("index");
                Route::post("/setLocale", [App\Http\Controllers\UserUi\AccountController::class, 'updateLocale'])->name("locale.do");
                Route::post("/do", [App\Http\Controllers\UserUi\AccountController::class, 'update'])->name("do");
            });

            Route::prefix("/password")->name("password.update.")->group(function () {
                Route::post("/", [App\Http\Controllers\UserUi\Password_changeController::class, 'changeIndex'])->name("index");
                Route::post("/do", [App\Http\Controllers\UserUi\Password_changeController::class, 'change'])->name("do");
            });

            Route::prefix("/remove")->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\UserUi\AccountController::class, 'remove'])->name("do");
            });
            Route::post("/change_picture", [App\Http\Controllers\UserUi\AccountController::class, 'change_picture'])->name("change_picture");
        });


        Route::prefix("/notification")->name("notification.")->group(function () {
            Route::post("/", [App\Http\Controllers\UserUi\NotificationController::class, 'index'])->name("index");
            Route::prefix("/remove")->name("remove.")->group(function () {
                Route::post("/", [App\Http\Controllers\UserUi\NotificationController::class, 'removeIndex'])->name("index");
                Route::post("/do", [App\Http\Controllers\UserUi\NotificationController::class, 'remove'])->name("do");
            });
        });


        Route::get('/{url}', [App\Http\Controllers\UserUi\IndexController::class, 'index'])->where('url', '.*');
    });
});
