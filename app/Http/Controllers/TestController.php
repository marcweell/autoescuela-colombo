<?php

namespace App\Http\Controllers;

use App\Services\bulk_message\EmailServiceImpl;
use App\Services\page_info\Page_infoServiceImpl;
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
        $this->modules();

        //$userIp = getIp();
        //$locationData = \Location::get($userIp);
        //dd($locationData);

        //$page = _info("home.slider");

        //dd($page);
    }

    public function modules()
    {



        $routeCollection = Route::getRoutes();

        DB::table("permission")->delete();
        DB::table("module")->delete();
        DB::statement('alter table module auto_increment = 1');
        DB::statement('alter table permission auto_increment = 1');
        DB::statement('alter table role_permission auto_increment = 1');


        $mods = [];
        $pre = ["web.admin.", "api.", "web.api."];



        foreach ($routeCollection as $value) {

            $name = $value->getName();

            if (str_contains($name, "account") == true) {
                continue;
            }
            if (str_contains($name, "profile") == true) {
                continue;
            }

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

                    //$name = $val . $name;

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
        $permja = [];

        $permissions = [];

        foreach ($routeCollection as $value) {
            $name = $value->getName();

            if (str_ends_with($name, '.do') == true) {
                $name = substr($name, 0, strlen($name) - 3);
            }

            $name = str_replace('.update.index', '.update', $name);
            $name = str_replace('.add.index', '.add', $name);

            if (str_ends_with($name, ".")) {
                continue;
            }

            if (empty($name)) {
                continue;
            }

            if (str_starts_with($name, "ign")) {
                continue;
            }
            if (str_contains($name, "account") == true) {
                continue;
            }
            if (str_contains($name, "profile") == true) {
                continue;
            }

            $use = $value->getAction()["uses"];

            $permit = [
                "isview" => false,
                "isgroup" => false,
                "permission" => "admin.",
            ];


            if (str_contains($name, ".index") == true) {
                $permit["isview"] = true;
            }



            $name = str_replace('index', 'read', $name);
            $name = str_replace('index', 'read', $name);
            $name = str_replace('web.', '', $name);
            $name = str_replace('.remove.read', '.read', $name);
            $name = str_replace('.list', '.read', $name);
            $name = str_replace('reportwnload', 'report.download', $name);


            if (str_starts_with($name, "app.")) {
                continue;
            }

            $permit["permission"] = $name;


            try {

                $permissions[$use] = $permit;
            } catch (\Throwable $th) {
                //   dd($use);
            }
            $routeName = $value->getName();
            $module = 0;


            foreach ($modules as $key => $value) {

                if (str_contains($name, $value->code) and $value->code !== "admin") {
                    $module = $value->id;
                    break;
                }

                if (str_contains($name, "." . $value->code)) {
                    $module = $value->id;
                    break;
                }
            }

            if (empty($module) and str_contains($name, ".")) {
                continue;
            }

            if (empty($module)) {
                continue;
            }

            if (isset($permja[$name])) {
                continue;
            }
            $permja[$name] = true;
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


        $pr_json = json_encode($arr);
        $md_json = json_encode($modules);


        tools()->write(base_path("config/permissions.php"), $pre . $json . ";");
        tools()->write(base_path("database/json/permission.json"), $pr_json);
        tools()->write(base_path("database/json/modules.json"), $md_json);
        return $pr_json;
    }
}
