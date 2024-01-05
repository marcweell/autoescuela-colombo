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


    function __destruct()
    {
        $this->handle();
    }
    public function getDescription()
    {


        $a = Route::getCurrentRoute()->getActionName();
        $a = substr($a, strpos($a, "@") + 1);

        $name = Route::getCurrentRoute()->getName();

        $pre = ["web.app.", "web.apps", "web.admin.", "api.", "web.api.", "web."];


        foreach ($pre as $key => $val) {
            if (str_starts_with($name, $val)) {
                $name = substr($name, strlen($val));
                if (str_contains($name, ".") == false) {
                    continue;
                }
            }
        }


        $contents = [
            "crm" => "Pagina de Cliente",
            "admin" => "Pagina de Administrador",
            "course.course."=>"Curso",
            "project.project"=>"Projecto",
            "course.course.index"=>"Lista de Cursos",
            "file"=>"Arquivo",
            "file.index"=>"Lista de Arquivos", 
        ];
        $verbs = [
            ".index" => "Visualizou ",
            ".add.do" => "Adicionou ",
            ".update.do" => "Editou ",
            ".remove.do" => "Removeu ",
        ];
        $content = "";
        $verb = "";
        foreach ($contents as $key => $value) {
            if (str_starts_with($name, $key)) {
                $content = $value;
            }
        }

        $content = empty($content) ? strtoupper($name) : $content;

        foreach ($verbs as $key => $value) {
            if (str_ends_with($name, $key)) {
                $verb = $value;
            }
        }
        $content = $verb . $content;
        $name =  $content;


        return __($name);
    }
    public function handle(){

        $data = new \stdClass();
        $data->code = code(null, __METHOD__);
        $data->user_id = Auth::check() ? Auth::user()->id : null;
        $data->classMethod = Route::getCurrentRoute()->getActionName();
        $data->description = $this->getDescription();
        $data->old_serialized_object = serialize(null);
        (new Operation_historyServiceImpl())->add($data);
    }
}
