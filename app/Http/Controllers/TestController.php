<?php

namespace App\Http\Controllers;

use App\Services\bulk_message\EmailServiceImpl;
use Flores;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/**
 *
 *
 *
 * Execute Any Developing Test
 */
class TestController extends Controller
{

    function test()
    {
        #$this->modules();

        //$userIp = getIp();
        //$locationData = \Location::get($userIp);
        //dd($locationData);


    }

    public function modules()
    {

        $routeCollection = Route::getRoutes();

      DB::table("permission")->delete();
       DB::table("module")->delete();


        $mods = [];
        $pre = ["web.app.", "web.apps", "web.admin.", "api.", "web.api.", "web."];



        foreach ($routeCollection as $value) {
            $name = $value->getName();
            foreach ($pre as $key => $val) {
                if (str_starts_with($name, $val)) {

                    $name = substr($name, strlen($val));
                    if (str_contains($name, ".") == false) {
                        continue;
                    }
                    $name = substr($name, 0, strpos($name, "."));
                    if (empty($name) and str_contains($val, "web.admin")) {
                        $name = "admin";
                    }
                    //  $name = $val . $name;
                    array_push(
                        $mods,
                        [
                            "code" => $name,
                            "name" => $name
                        ]
                    );
                }
            }
        }

        DB::table("module")->upsert($mods, ["code"]);

        $modules = DB::table('module')->get();
        $arr = [];


        $permissions = [];

        foreach ($routeCollection as $value) {
            $name = $value->getName();
            $name = str_replace('.do', '', $name);
            $name = str_replace('.update.index', '.read', $name);
            $name = str_replace('.add.index', '.read', $name);
            if (str_ends_with($name, ".")) {
                continue;
            }
            if (empty($name)) {
                continue;
            }
            if (str_starts_with($name, "ign")) {
                continue;
            }


            $use = $value->getAction()["uses"];
            $permit = [
                "is_html" => false,
                "is_prefix" => false,
                "permission" => "admin.",
                "require_master_key" => false,
            ];


            if (str_contains($name, ".index") == true) {
                $permit["is_html"] = true;
            }
            if (str_contains($name, ".developer") == true) {
                $permit["require_master_key"] = true;
            }


            $name = str_replace('index', 'read', $name);
            $name = str_replace('index', 'read', $name);
            $name = str_replace('web.', '', $name);
            $name = str_replace('.remove.read', '.read', $name);
            $name = str_replace('reportwnload', 'report.download', $name);

            $permit["permission"] = $name;


            try {

                $permissions[$use] = $permit;
            } catch (\Throwable $th) {
                //   dd($use);
            }
            $routeName = $value->getName();
            $module = 0;
            foreach ($modules as $key => $value) {
                if (str_contains($name, $value->code)) {
                    $module = $value->id;
                    break;
                }
            }

            if (empty($module) and str_contains($name, ".")) {
                dd($name);
                continue;
            }


            array_push($arr, [
                'name' => $name,
                'code' => $name,
                'module_id' => $module,
            ]);
        }

        DB::table("permission")->upsert(
            $arr,
            ['code']
        );
        DB::table("role_permission")->delete();
        foreach (DB::table('permission')->get() as $key => $value) {
            DB::table("role_permission")->insert(
                [
                    'role_id' => 1,
                    'permission_id' => $value->id
                ]
            );
        }
        $json = json_encode($permissions);
        $pre = "<?php return ";
        $json = str_replace("{", "[", $json);
        $json = str_replace("}", "]", $json);
        $json = str_replace(":", "=>", $json);
        $json = str_replace(",", ",\n", $json);


        tools()->write(base_path("config/permissions.php"), $pre . $json . ";");
        die(json_encode($permissions));
    }
}
