<?php

namespace App\Http\Controllers\CrmUi;

use Flores\WebApi; 
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    private $courseService;
    function __construct()
    {
    }

    public function Index(Request $request)
    {

        return view("crm.pages.home");
    }
}
 