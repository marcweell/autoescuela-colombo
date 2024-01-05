<?php

namespace Flores\Shield;

use Illuminate\Support\Facades\Request;
use App\Services\operation_history\Operation_historyServiceImpl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use stdClass;

class Shield
{
    private $request = null;
    private $user_id = null;
    public function __construct(?Request $request = null)
    {
       
        $this->request = $request;
        $this->user_id = Auth::check() ? Auth::user()->id : null;
    } 

}
