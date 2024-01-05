<?php

namespace App\Services\bulk_message;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

/** @author Nelson Flores | nelson.flores@live.com */

class Bulk_messageServiceImpl implements IBulk_messageService
{

    private $table =  'bulk_message';
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
        $bulk_message = DB::table($this->table)->where('id', $id)->first();

        if (empty($bulk_message->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
    private function queue(){}
    public function setBody(string $body){}
    public function addRecipient(string $email){}
    public function addRecipients(array $emails){}    
    public function send(){} 
    public function save(){} 
}
