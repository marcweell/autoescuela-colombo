<?php

namespace App\Services\survey_person_attachment;

use App\Services\file\FileServiceImpl;
use App\Services\file\FileServiceQueryImpl;


use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class Survey_person_attachmentServiceImpl implements ISurvey_person_attachmentService
{
    private $insertFillables = ['name', 'code'];
    private $updateFillables = ['name', 'code'];
    private $table =  'survey_person_attachment';


    public function add($data)
    {
        if (empty($data->attach) and empty($data->survey_person_id)) {
            throw new \Exception(__(__('Entrada Invalida'), 400));
        }
        if (!is_array($data->attach) and !is_numeric($data->survey_person_id)) {
            throw new \Exception(__(__('Entrada Invalida'), 400));
        }

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        $arr = [];

        foreach ($data->attach as $i => $value) {

            $value['code'] = $data->code . pinCode();
            (new FileServiceImpl())->add($value);

            array_push(
                $arr,
                [
                    'code' => $value['code'],
                    'file_id' => (new FileServiceQueryImpl())->findByCode($value['code'])->id,
                    'survey_person_id' => $data->survey_person_id,
                ]
            );
        }

        DB::table($this->table)->upsert($arr, 'code');
    }

    public function update($data)
    {
        //------------
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
