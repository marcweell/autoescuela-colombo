<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class NotFoundController extends Controller
{

    function handle(Request $request)
    { 

        switch (strtoupper($request::method())) {
            case 'POST':
                return hh(404); 
            case 'GET':
                return hh(404,view('error.404')->render()); 
            default:
                return hh(404); 
        }
    }
}
