<?php

namespace App\Services\bulk_message;

use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

/** @author Nelson Flores | nelson.flores@live.com */

class SmsServiceImpl implements IBulk_messageService
{
    private $table =  'bulk_message';


    private $provider;

    private $recipients = [];
    private $body = '';
    private $succeded = false;
    private $async = false;
    private $apiReturnMessage = '';

    private $dashboard_sid;
    private $auth_token;
    private $twilio_number;

    public function __construct()
    {
        $this->dashboard_sid = env('TWILIO_ID');
        $this->auth_token = env('TWILIO_AUTH_TOKEN');
        $this->twilio_number = env('TWILIO_NUMBER');
        $this->provider =  new Client($this->dashboard_sid, $this->auth_token);
    }

    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
    public function addRecipient($email)
    {
        array_push($this->recipients, $email);

        return $this;
    }
    public function addRecipients($emails)
    {
        array_merge($this->recipients, $emails);

        return $this;
    }

    public function sync()
    {
        $this->async = false;

        return $this;
    }

    public function queue()
    {

        return $this;
    }


    public function send()
    {
        try {
            foreach ($this->recipients as $key => $number) {
                $this->apiReturnMessage =  $this->provider->messages->create(
                    $number,
                    array(
                        'from' => $this->twilio_number,
                        'body' => $this->body,
                    )
                );
                $this->succeded = true;
            }
        } catch (\Exception $e) {
            throw  $e;
        }
        $this->save();

        return $this;
    }

    public function getMessage()
    {
        return $this->apiReturnMessage;
    }
    public function save()
    {
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
        DB::table($this->table)->where('id', $id)->delete();
    }
}
