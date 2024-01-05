<?php

namespace App\Services\gallery;

use App\Services\file\FileServiceImpl;
use App\Services\file\FileServiceQueryImpl;
use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

/** @author Nelson Flores | nelson.flores@live.com */

class GalleryServiceImpl implements IGalleryService
{
    private $insertFillables = ["name","code"];
    private $updateFillables = ["name","code"];
    private $table =  'gallery';


    function add($data)
    {
        
        if (empty($data->attach)) {
            throw new \Exception(__('Forneca o Nome'));
        }

        $arr = [];
      
       
        foreach ($data->attach as $i => $value) {
            $value_ = new \stdClass;
            $value_->filename = $value['file'];
            $value_->name = $value['filename'];
            $value_->code = md5($data->code . $i . time());
            
            $code = md5($value_->name . time());
            $arquive = Flores\Tools::upload_base64($value_->filename, $code, "storage/files/gallery/original");
            Flores\Tools::compress_image(storage_path("files/gallery/original/".$arquive),storage_path("files/gallery/square/".$arquive),100,300,300,true);
             
            array_push(
                $arr,
                [
                    'code' => $value_->code,
                    'archive'=>$arquive,
                    'filename' => $value_->name, 
                ]
            );
        }




        DB::table($this->table)->upsert($arr, "code");
        
    }

    function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception('Dados Invalidos');
        }

        $gallery = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($gallery->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }

       


        $data->code = code(empty($data->code)?null:$data->code,__METHOD__);
        $arr = json_decode(json_encode($data),true);

        foreach ($arr as $i => $value) {
            if (!in_array($i,$this->updateFillables)) {
                //unset($arr[$i]);
            }
        }

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);

    }

    function delete($id)
    {
        $gallery = DB::table($this->table)->where('id', $id)->first();

        if (empty($gallery->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
