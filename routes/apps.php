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
 

Route::prefix("/basic")->name("web.apps.")->middleware([App\Http\Middleware\MyCompany::class, App\Http\Middleware\WebValidSession::class])->group(function () {

    Route::prefix("/fleet")->name("fleet.")->group(function () {
        Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'index'])->name("index");


        Route::prefix("/employee")->name("employee.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'employeeIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listEmployeeIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addEmployeeIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateEmployeeIndex'])->name("index");
            });
        });

        Route::prefix("/vehicle")->name("vehicle.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'vehicleIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listVehicleIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addVehicleIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateVehicleIndex'])->name("index");
            });
        });

        Route::prefix("/fuel")->name("fuel.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'fuelIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listFuelIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addFuelIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateFuelIndex'])->name("index");
            });
        });

        Route::prefix("/maintenance")->name("maintenance.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'maintenanceIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listMaintenanceIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addMaintenanceIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateMaintenanceIndex'])->name("index");
            });
        });

        Route::prefix("/trip")->name("trip.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'tripIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listTripIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addTripIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateTripIndex'])->name("index");
            });
        });

        Route::prefix("/tracking")->name("tracking.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'trackingIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listTrackingIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addTrackingIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateTrackingIndex'])->name("index");
            });
        });


        Route::prefix("/geofence")->name("geofence.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'geofenceIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listGeofenceIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addGeofenceIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateGeofenceIndex'])->name("index");
            });
        });


        Route::prefix("/finance")->name("finance.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'financeIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listFinanceIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addFinanceIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateFinanceIndex'])->name("index");
            });
        });


        Route::prefix("/settings")->name("settings.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'settingsIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listSettingsIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addSettingsIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateSettingsIndex'])->name("index");
            });
        });


        Route::prefix("/dashboard")->name("dashboard.")->group(function () {

            Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'dashboardIndex'])->name("index");
            Route::post("/list", [App\Http\Controllers\AppsUi\FleetController::class, 'listDashboardIndex'])->name("list.index");

            Route::prefix("/add")->name("add.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'addDashboardIndex'])->name("index");
            });
            Route::prefix("/update")->name("update.")->group(function () {
                Route::post("/", [App\Http\Controllers\AppsUi\FleetController::class, 'updateDashboardIndex'])->name("index");
            });
        });
    });

    #-----------------------------------------------------------------------------------------------------------------------------------------

    Route::prefix("/sell")->name("sell.")->group(function () {
        Route::post("/", [App\Http\Controllers\AppsUi\SellController::class, 'sellIndex'])->name("index");
    });

    #-----------------------------------------------------------------------------------------------------------------------------------------

    Route::prefix("/finances")->name("finance.")->group(function () {
        Route::post("/", [App\Http\Controllers\AppsUi\SellController::class, 'sellIndex'])->name("index");
    });


    #-----------------------------------------------------------------------------------------------------------------------------------------

    Route::post("/", [App\Http\Controllers\AppsUi\IndexController::class, 'mainIndex'])->name('index');
    Route::get("/", [App\Http\Controllers\AppsUi\IndexController::class, 'index'])->name('index');
    Route::get('/{url}', [App\Http\Controllers\AppsUi\IndexController::class, 'index'])->where('url', '.*');
});
