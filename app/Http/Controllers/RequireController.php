<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flores\Tools;

class RequireController extends Controller
{

    function require(Request $request)
    {
        $url = base64_decode($request->get("url"));

        $token = Tools::decode($request->get("token"), 1); 

        if ($url !== $token) {
            return hh(401);
        }
        
        return response(trim(file_get_contents($url)), 200, [
            'content-type' => $request->get("content-type")
        ]);
    
    }
}
