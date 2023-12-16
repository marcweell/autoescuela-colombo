<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request; 

/**
 *  
 * Error Pages

 */
class ErrorController extends Controller
{



    function _404(Request $request)
    { 
        return response(view("error.404"))->setStatusCode(404); 
    }
 
    function _500(Request $request)
    { 
        return response(view("error.500"))->setStatusCode(500); 
    }

    function _501(Request $request)
    { 
        return response(view("error.501"))->setStatusCode(501); 
    }
 
}
