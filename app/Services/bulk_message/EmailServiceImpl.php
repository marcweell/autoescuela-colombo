<?php

namespace App\Services\bulk_message;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Jobs\EmailSender;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\SMTP;

/** @author Nelson Flores | nelson.flores@live.com */

class EmailServiceImpl implements IBulk_messageService
{
    private $table =  'bulk_message';


    private $provider;
    private $async = true;
    private $themed = false;

    private $recipients = [];
    private $attachs = [];
    private $body = '';
    private $subject = '';

    public function __construct($subject = '')
    {
        try {

            $this->subject = $subject;

            $this->provider = new PHPMailer(true);
            //Server settings
            $this->provider->SMTPDebug = 2;//SMTP::DEBUG_OFF;
            $this->provider->isSMTP();
            $this->provider->CharSet = 'UTF-8';
            $this->provider->Host = env('MAIL_HOST');
            $this->provider->Username = env('MAIL_USERNAME');
            $this->provider->Password = env('MAIL_PASSWORD');
            $this->provider->Port = env('MAIL_PORT');
            $this->provider->SMTPAuth = true;
            $this->provider->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //Recipients
            $this->provider->setFrom(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
    public function getBody()
    {
        return $this->body;
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
    public function addattach($file_location, $name)
    {
        array_push($this->attachs, ['file' => $file_location, 'name' => $name]);

        return $this;
    }

    public function sync()
    {
        $this->async = false;

        return $this;
    }

    private function queue()
    {
        $job = (new EmailSender($this->provider));

        dispatch($job)->delay(now()->addSeconds('5'));

        return true;
    }

    public function send()
    {
        $data = [
            ''
        ];
        try {
            foreach ($this->recipients as $key => $value) {
                $this->provider->addAddress($value);
            }
            foreach ($this->attachs as $key => $value) {
                // Attachments
                $this->provider->addAttachment($value['file'], $value['name']);
            }

            // Content
            $this->provider->isHTML(true);
            $this->provider->Subject = $this->subject;
            $this->provider->Body = $this->getBody();

            if ($this->async == true) {
                return $this->queue();
            } else {
                $this->provider->send();
            }
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function save(){

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
