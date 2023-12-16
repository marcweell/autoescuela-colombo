<?php

namespace App\Services\bulk_message;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Jobs\EmailSender; 
use Illuminate\Support\Facades\DB;
use Mpdf\Tag\Th;
use PHPMailer\PHPMailer\SMTP;



class EmailServiceImpl implements IBulk_messageService
{ 

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
            
            #SMTP::DEBUG_OFF (0): Desativar o debug (você pode deixar sem preencher este valor, uma vez que esta opção é o padrão).
            #SMTP::DEBUG_CLIENT (1): Imprimir mensagens enviadas pelo cliente.  
            #SMTP::DEBUG_SERVER (2): similar ao 1, mais respostas recebidas dadas pelo servidor (esta é a opção mais usual).
            #SMTP::DEBUG_CONNECTION (3): similar ao 2, mais informações sobre a conexão inicial - este nível pode auxiliar na ajuda com falhas STARTTLS.
            #SMTP::DEBUG_LOWLEVEL (4): similar ao 3, mais informações de baixo nível, muito prolixo, não use para debugar SMTP, apenas em problemas de baixo nível.

            $this->provider->SMTPDebug = SMTP::DEBUG_OFF;
            
            $this->provider->isSMTP();
            $this->provider->CharSet = 'UTF-8';
            $this->provider->Host = 'smtp.hostinger.com';
            $this->provider->Username = 'no-reply@behappyworld.pro';
            $this->provider->Password = 'Iamsolomongrundy@1';
            $this->provider->Port = 465;
            $this->provider->SMTPAuth = true;
            $this->provider->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_STARTTLS;

            //Recipients
            $this->provider->setFrom('no-reply@behappyworld.pro',config('app.name'));
        } catch (Exception $e) {
            
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

    public function sync($bool = true)
    {
        $this->async = $bool;

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
        }
    }
 
}
