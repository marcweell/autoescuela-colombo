<?php

namespace App\Services\bulk_message;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class Bulk_messageServiceImpl implements IBulk_messageService
{

    private $table =  'bulk_message';

    function delete($id)
    {
        $bulk_message = DB::table($this->table)->where('id', $id)->first();

        if (empty($bulk_message->id)) {
            throw new \Exception(__('Conteudo nao encontrado'));
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
    private function queue(){}
    public function setBody(string $body){}
    public function addRecipient(string $email){}
    public function addRecipients(array $emails){}    
    public function send(){} 
    function save(){} 
}
