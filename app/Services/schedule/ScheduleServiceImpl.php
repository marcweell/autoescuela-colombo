<?php

namespace App\Services\schedule;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use stdClass;
use Flores;




class ScheduleServiceImpl implements IScheduleService
{
    private $insertFillables = ['code', 'name',];
    private $updateFillables = ['code', 'name', 'updated_at', 'deleted_at'];
    private $table = 'schedule';


    public function add($data)
    {
        if (empty($data->email)) {
            throw new \Exception(__('Email invalido'), 400);
        }
        $payload = new stdClass();

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $schedule = (new ScheduleServiceQueryImpl())->findByCode($data->code);

        if (!empty($schedule->id)) {
            throw new \Exception(__('Nombre de usuario no válido'), 400);
        }

        $arr = json_decode(json_encode($payload), true);


        DB::table($this->table)->insert($arr);
    }

    public function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }


        $payload = new stdClass();


        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }


        $schedule = (new ScheduleServiceQueryImpl())->findById($data->id);

        if (empty($schedule->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        if (isset($data->code)) {
            if ($schedule->code !== $data->code) {
                throw new \Exception(__('Nombre de usuario no válido, tente outro'), 400);
            }
        }

        $arr = json_decode(json_encode($payload), true);

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }
    public function trash($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => DB::raw('now()')]);
    }
    public function restore($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => null]);
    }
    public function delete($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
