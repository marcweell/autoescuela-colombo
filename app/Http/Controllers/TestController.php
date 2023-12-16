<?php

namespace App\Http\Controllers;

use App\Jobs\Report;
use App\Services\invited_user\Invited_userServiceQueryImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
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


Artisan::call("view:clear");
        return 'ok';
        $users = (new UserServiceQueryImpl())->findAll();

        foreach ($users as $key => $user) {
            $invi = (new Invited_userServiceQueryImpl())->byUserInvitedId($user->id)->find();
            if (empty($invi->user_id)) {
                continue;
            }
            $user->indicator_id = $invi->user_id;

            (new UserServiceImpl())->update($user);
        }

    }
   
}
