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



Route::prefix("/admin")->name("web.admin.")->middleware(App\Http\Middleware\WebAdminValidSession::class)->group(function () {
    Route::get("/", [App\Http\Controllers\AdminUi\IndexController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name('index');
    Route::post("/", [App\Http\Controllers\AdminUi\IndexController::class, 'postIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name('postIndex');

    #---------------------------------------------------------------------------------------------------------------

    Route::prefix("/api")->name("api.")->middleware([])->group(function () {

        Route::prefix("/listen")->name("listen.")->group(function () {
            Route::post("/notification", [App\Http\Controllers\UserUi\NotificationController::class, 'getNotification'])->name("notification.index");
        });

    });




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
    Route::prefix("/course")->middleware([App\Http\Middleware\CheckPermission::class])->name("course.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\CourseController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
        Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\CourseController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\CourseController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\CourseController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\CourseController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

            Route::post("/do", [App\Http\Controllers\AdminUi\CourseController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/detail")->middleware([App\Http\Middleware\CheckPermission::class])->name("detail.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\CourseController::class, 'detailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
        });
    });


    #---------------------------------------------------------------------------------------------------------------
    Route::prefix("/cursos")->middleware([App\Http\Middleware\CheckPermission::class])->name("course_container.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\Course_containerController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
        Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Course_containerController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\Course_containerController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Course_containerController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\Course_containerController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

            Route::post("/do", [App\Http\Controllers\AdminUi\Course_containerController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/detail")->middleware([App\Http\Middleware\CheckPermission::class])->name("detail.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Course_containerController::class, 'detailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
        });
    });



    #---------------------------------------------------------------------------------------------------------------
    Route::prefix("/survey")->middleware([App\Http\Middleware\CheckPermission::class])->name("survey.")->group(function () {

        Route::prefix("/survey_question")->middleware([App\Http\Middleware\CheckPermission::class])->name("survey_question.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Survey_questionController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_questionController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_questionController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_questionController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_questionController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_questionController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/survey_answer")->middleware([App\Http\Middleware\CheckPermission::class])->name("survey_answer.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Survey_answerController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_answerController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_answerController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_answerController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_answerController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_answerController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/survey_answers")->middleware([App\Http\Middleware\CheckPermission::class])->name("survey_person.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Survey_personController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_personController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_personController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_personController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_personController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_personController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/survey")->name("survey.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'index'])->name("index");
            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'addIndex'])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'add'])->name("do");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'updateIndex'])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'update'])->name("do");
            });
            Route::prefix("/remove")->name("remove.")->group(function () {
                Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'remove'])->name("do");
            });
            Route::post("/print", [App\Http\Controllers\AdminUi\SurveyController::class, 'print'])->name("print");

            Route::prefix("/question")->name("question.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'index'])->name("index");
                Route::prefix("/add")->name("add.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'addQuestionIndex'])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'addQuestion'])->name("do");
                });
                Route::prefix("/update")->name("update.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'updateIndex'])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'update'])->name("do");
                });
                Route::prefix("/remove")->name("remove.")->group(function () {
                    Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'remove'])->name("do");
                });
                Route::post("/print", [App\Http\Controllers\AdminUi\SurveyController::class, 'print'])->name("print");
            });



            Route::prefix("/answer")->name("answer.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'index'])->name("index");
                Route::prefix("/add")->name("add.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'addAnswerIndex'])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'addAnswer'])->name("do");
                });
                Route::prefix("/update")->name("update.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\SurveyController::class, 'updateIndex'])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'update'])->name("do");
                });
                Route::prefix("/remove")->name("remove.")->group(function () {
                    Route::post("/do", [App\Http\Controllers\AdminUi\SurveyController::class, 'remove'])->name("do");
                });
                Route::post("/print", [App\Http\Controllers\AdminUi\SurveyController::class, 'print'])->name("print");
            });
        });

        /**
         * .ADMIN
         */

        Route::get('/{url}', [App\Http\Controllers\AdminUi\IndexController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->where('url', '.*');
    });




    #---------------------------------------------------------------------------------------------------------------
    Route::prefix("/user")->middleware([App\Http\Middleware\CheckPermission::class])->name("user.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\UserController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
        Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\UserController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\UserController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/detail")->middleware([App\Http\Middleware\CheckPermission::class])->name("detail.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\UserController::class, 'detailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
        });
        Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {
            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/export")->middleware([App\Http\Middleware\CheckPermission::class])->name("export.")->group(function () {
            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'export'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });
        Route::prefix("/approve")->middleware([App\Http\Middleware\CheckPermission::class])->name("approve.")->group(function () {
            Route::post("/do", [App\Http\Controllers\AdminUi\UserController::class, 'approve'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
        });



        #----------------------------------------------

        Route::prefix("/group")->middleware([App\Http\Middleware\CheckPermission::class])->name("role.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\RoleController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\RoleController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\RoleController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\RoleController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\RoleController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\RoleController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            #----------------------------------------------

            Route::prefix("/permission")->middleware([App\Http\Middleware\CheckPermission::class])->name("role_permission.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Role_permissionController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\Role_permissionController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\Role_permissionController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
            });
        });
    });

    #---------------------------------------------------------------------------------------------------------------
    Route::prefix("/page")->middleware([App\Http\Middleware\CheckPermission::class])->name("page.")->group(function () {

        Route::prefix("/site_menu")->middleware([App\Http\Middleware\CheckPermission::class])->name("site_menu.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Site_menuController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Site_menuController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Site_menuController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Site_menuController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Site_menuController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Site_menuController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        #---------------------------------------------------------------------------------------------------------------
        Route::prefix("/page_info")->middleware([])->name("page_info.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Page_infoController::class, 'index'])->middleware([])->name("index");
            Route::prefix("/update")->middleware([])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Page_infoController::class, 'updateIndex'])->middleware([])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Page_infoController::class, 'update'])->middleware([])->name("do");
            });
            Route::prefix("/detail")->middleware([])->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Page_infoController::class, 'detailIndex'])->middleware([])->name("index");
            });
        });
        #---------------------------------------------------------------------------------------------------------------


        Route::prefix("/message")->middleware([App\Http\Middleware\CheckPermission::class])->name("message.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\MessageController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::post("/reply", [App\Http\Controllers\AdminUi\MessageController::class, 'replyIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("reply.index");
            Route::post("/compose", [App\Http\Controllers\AdminUi\MessageController::class, 'composeIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("compose.index");
            Route::prefix("/detail")->middleware([App\Http\Middleware\CheckPermission::class])->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\MessageController::class, 'detailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {
                Route::post("/do", [App\Http\Controllers\AdminUi\MessageController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/gallery")->middleware([App\Http\Middleware\CheckPermission::class])->name("gallery.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\GalleryController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\GalleryController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\GalleryController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\GalleryController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\GalleryController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\GalleryController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        /*

        Route::prefix("/subscriber")->middleware([App\Http\Middleware\CheckPermission::class])->name("subscriber.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\SubscriberController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\SubscriberController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\SubscriberController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\SubscriberController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\SubscriberController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {
                Route::post("/do", [App\Http\Controllers\AdminUi\SubscriberController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/partner")->middleware([App\Http\Middleware\CheckPermission::class])->name("partner.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\PartnerController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\PartnerController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\PartnerController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\PartnerController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\PartnerController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {
                Route::post("/do", [App\Http\Controllers\AdminUi\PartnerController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });


        Route::prefix("/services")->middleware([App\Http\Middleware\CheckPermission::class])->name("services.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\ServicesController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\ServicesController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\ServicesController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\ServicesController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\ServicesController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {
                Route::post("/do", [App\Http\Controllers\AdminUi\ServicesController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        */

        #---------------------------------------------------------------------------------------------------------------
        Route::post("/", [App\Http\Controllers\AdminUi\PageController::class, 'index'])->middleware([])->name("index");
        Route::prefix("/add")->middleware([])->name("add.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\PageController::class, 'addIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\PageController::class, 'add'])->middleware([])->name("do");
        });
        Route::prefix("/update")->middleware([])->name("update.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\PageController::class, 'updateIndex'])->middleware([])->name("index");
            Route::post("/do", [App\Http\Controllers\AdminUi\PageController::class, 'update'])->middleware([])->name("do");
        });
        Route::prefix("/remove")->middleware([])->name("remove.")->group(function () {

            Route::post("/do", [App\Http\Controllers\AdminUi\PageController::class, 'remove'])->middleware([])->name("do");
        });

        #----------------------------------------------

        #---------------------------------------------------------------------------------------------------------------
        Route::prefix("/category")->middleware([])->name("category.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Page_categoryController::class, 'index'])->middleware([])->name("index");
            Route::prefix("/add")->middleware([])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Page_categoryController::class, 'addIndex'])->middleware([])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Page_categoryController::class, 'add'])->middleware([])->name("do");
            });
            Route::prefix("/update")->middleware([])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Page_categoryController::class, 'updateIndex'])->middleware([])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Page_categoryController::class, 'update'])->middleware([])->name("do");
            });
            Route::prefix("/remove")->middleware([])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Page_categoryController::class, 'remove'])->middleware([])->name("do");
            });

            #----------------------------------------------

        });
    });
    #---------------------------------------------------------------------------------------------------------------
    Route::prefix("/settings")->middleware([App\Http\Middleware\CheckPermission::class])->name("settings.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\SettingsController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");

        #----------------------------------------------

        Route::prefix("/faq")->middleware([App\Http\Middleware\CheckPermission::class])->name("faq.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\FaqController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\FaqController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\FaqController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\FaqController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\FaqController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\FaqController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });
        #----------------------------------------------

        Route::prefix("/document_type")->middleware([App\Http\Middleware\CheckPermission::class])->name("document_type.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Document_typeController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Document_typeController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Document_typeController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Document_typeController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Document_typeController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Document_typeController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/contact_type")->middleware([App\Http\Middleware\CheckPermission::class])->name("contact_type.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Contact_typeController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Contact_typeController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Contact_typeController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Contact_typeController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Contact_typeController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Contact_typeController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });




        #----------------------------------------------
        Route::prefix("/survey_category")->middleware([App\Http\Middleware\CheckPermission::class])->name("survey_category.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Survey_categoryController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_categoryController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_categoryController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_categoryController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_categoryController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Survey_categoryController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/detail")->middleware([App\Http\Middleware\CheckPermission::class])->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Survey_categoryController::class, 'detailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            });
        });

        #----------------------------------------------
        Route::prefix("/course_category")->middleware([App\Http\Middleware\CheckPermission::class])->name("course_category.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Course_categoryController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Course_categoryController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Course_categoryController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Course_categoryController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Course_categoryController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Course_categoryController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/detail")->middleware([App\Http\Middleware\CheckPermission::class])->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Course_categoryController::class, 'detailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            });
        });

        #----------------------------------------------
        Route::prefix("/schedule")->middleware([App\Http\Middleware\CheckPermission::class])->name("schedule.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\ScheduleController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\ScheduleController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\ScheduleController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\ScheduleController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\ScheduleController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\ScheduleController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        #----------------------------------------------
        Route::prefix("/academic_degree")->middleware([App\Http\Middleware\CheckPermission::class])->name("academic_degree.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Academic_degreeController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Academic_degreeController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Academic_degreeController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Academic_degreeController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Academic_degreeController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Academic_degreeController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });



        Route::prefix("/gender")->middleware([App\Http\Middleware\CheckPermission::class])->name("gender.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\GenderController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\GenderController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\GenderController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\GenderController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\GenderController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\GenderController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });



        Route::prefix("/currency")->middleware([])->name("currency.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\CurrencyController::class, 'index'])->middleware([])->name("index");
            Route::prefix("/add")->middleware([])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\CurrencyController::class, 'addIndex'])->middleware([])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\CurrencyController::class, 'add'])->middleware([])->name("do");
            });
            Route::prefix("/update")->middleware([])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\CurrencyController::class, 'updateIndex'])->middleware([])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\CurrencyController::class, 'update'])->middleware([])->name("do");
            });
            Route::prefix("/remove")->middleware([])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\CurrencyController::class, 'remove'])->middleware([])->name("do");
            });
            Route::prefix("/detail")->middleware([])->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\CurrencyController::class, 'detailIndex'])->middleware([])->name("index");
            });
        });


        Route::prefix("/geo")->middleware([App\Http\Middleware\CheckPermission::class])->name("geo.")->group(function () {
            Route::prefix("/country")->middleware([App\Http\Middleware\CheckPermission::class])->name("country.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\CountryController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\CountryController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\CountryController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
                Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\CountryController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\CountryController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
                Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                    Route::post("/do", [App\Http\Controllers\AdminUi\CountryController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
            });


            Route::prefix("/city")->middleware([App\Http\Middleware\CheckPermission::class])->name("city.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\CityController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\CityController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\CityController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
                Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\CityController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\CityController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
                Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                    Route::post("/do", [App\Http\Controllers\AdminUi\CityController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
            });

            Route::prefix("/village")->middleware([App\Http\Middleware\CheckPermission::class])->name("village.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\VillageController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\VillageController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\VillageController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
                Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                    Route::post("/", [App\Http\Controllers\AdminUi\VillageController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                    Route::post("/do", [App\Http\Controllers\AdminUi\VillageController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
                Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                    Route::post("/do", [App\Http\Controllers\AdminUi\VillageController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
                });
            });
        });
    });


    #---------------------------------------------------------------------------------------------------------------

    Route::prefix("/bulk_message")->middleware([App\Http\Middleware\CheckPermission::class])->name("bulk_message.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\Bulk_messageController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");

        Route::prefix("/sms")->middleware([App\Http\Middleware\CheckPermission::class])->name("sms.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Bulk_messageController::class, 'smsIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/compose")->middleware([App\Http\Middleware\CheckPermission::class])->name("compose.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Bulk_messageController::class, 'composeSmsIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/send", [App\Http\Controllers\AdminUi\Bulk_messageController::class, 'sendSms'])->middleware([App\Http\Middleware\CheckPermission::class])->name("send");
            });
        });
        Route::prefix("/email")->middleware([App\Http\Middleware\CheckPermission::class])->name("email.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Bulk_messageController::class, 'emailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/compose")->middleware([App\Http\Middleware\CheckPermission::class])->name("compose.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Bulk_messageController::class, 'composeEmailIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/send", [App\Http\Controllers\AdminUi\Bulk_messageController::class, 'sendEmail'])->middleware([App\Http\Middleware\CheckPermission::class])->name("send");
            });
        });
    });




    #---------------------------------------------------------------------------------------------------------------
    Route::prefix("/auditory")->middleware([App\Http\Middleware\CheckPermission::class])->name("auditory.")->group(function () {
        Route::prefix("/session_history")->middleware([App\Http\Middleware\CheckPermission::class])->name("session_history.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Session_historyController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/detail")->middleware([App\Http\Middleware\CheckPermission::class])->name("detail.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Session_historyController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\Session_historyController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });
    });



    #---------------------------------------------------------------------------------------------------------------
    Route::prefix("/developer")->middleware([App\Http\Middleware\CheckPermission::class])->name("developer.")->group(function () {
        Route::post("/", [App\Http\Controllers\AdminUi\DeveloperController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");

        Route::prefix("/module")->middleware([App\Http\Middleware\CheckPermission::class])->name("module.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\ModuleController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\ModuleController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\ModuleController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\ModuleController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\ModuleController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\ModuleController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/permission")->middleware([App\Http\Middleware\CheckPermission::class])->name("permission.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\PermissionController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\PermissionController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\PermissionController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\PermissionController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\PermissionController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\PermissionController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/language")->middleware([App\Http\Middleware\CheckPermission::class])->name("language.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\LanguageController::class, 'index'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\LanguageController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\LanguageController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\LanguageController::class, 'updateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\LanguageController::class, 'update'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {

                Route::post("/do", [App\Http\Controllers\AdminUi\LanguageController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });

        Route::prefix("/page_info")->middleware([App\Http\Middleware\CheckPermission::class])->name("page_info.")->group(function () {
            Route::post("/", [App\Http\Controllers\AdminUi\Page_infoController::class, 'ListIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
            Route::prefix("/add")->middleware([App\Http\Middleware\CheckPermission::class])->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Page_infoController::class, 'addIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Page_infoController::class, 'add'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/update")->middleware([App\Http\Middleware\CheckPermission::class])->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AdminUi\Page_infoController::class, 'coreUpdateIndex'])->middleware([App\Http\Middleware\CheckPermission::class])->name("index");
                Route::post("/do", [App\Http\Controllers\AdminUi\Page_infoController::class, 'coreUpdate'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
            Route::prefix("/remove")->middleware([App\Http\Middleware\CheckPermission::class])->name("remove.")->group(function () {
                Route::post("/do", [App\Http\Controllers\AdminUi\Page_infoController::class, 'remove'])->middleware([App\Http\Middleware\CheckPermission::class])->name("do");
            });
        });
    });
    #---------------------------------------------------------------------------------------------------------------


    Route::get('/{url}', [App\Http\Controllers\AdminUi\IndexController::class, 'index'])->where('url', '.*');
});
