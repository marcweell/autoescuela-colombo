<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 *
 * Execute Any Developing Test
 */
class TestController extends Controller
{

    function test(Request $request)
    {
        if ($request->has("artisan")) {
            Artisan::call($request->get("artisan"));
        }

    }

}
