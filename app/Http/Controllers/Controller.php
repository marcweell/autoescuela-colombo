<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Services\operation_history\Operation_historyServiceImpl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Flores\Shield\Shield;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(?Request $request = null)
    {
    }

}
