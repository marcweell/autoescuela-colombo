<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\message\MessageServiceImpl;
use App\Services\subscriber\SubscriberServiceImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class WebApiController extends Controller
{
    function __construct()
    {
    }


}
