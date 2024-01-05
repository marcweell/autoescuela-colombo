<?php

namespace App\Services\pdf;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;


use Dompdf\Dompdf;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class DomPdfServiceImpl implements IPDFService {

    private $table;
    private $user = null;
    private $values = [];
    private $themed = false;
    private $titulo = '';
    private $content = '';
    private $orientation = 'portrait';

    public function __construct()
    { 
        set_time_limit(0); 
    }

    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    public function user($user)
    {
        $this->user = $user;

        return $this;
    }

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    public function generate(): DomPdf
    {
        try {
            $conteudo = $this->content;
            if ($this->themed) {
                $table = [];
                foreach ($this->table ?? [] as $key => $value) {
                    try {
                        $arr = json_decode(json_encode($value), true);
                        foreach ($this->values as $i => $item) {
                            $arr[$item] = $arr[$i];
                            unset($arr[$i]);
                        }
                        array_push($table, $arr);
                    } catch (\Throwable $tah) {
                    }
                }
                $table = json_decode(json_encode($table));
                $conteudo = view('pdf.table', [
                    'user' => $this->user ?? (Auth::check() ? Auth::user() : null),
                    'titulo' => $this->titulo,
                    'table' => $table,
                    ])->render();
                $conteud = html_entity_decode($conteudo);
            }
            $dompdf = new Dompdf();
            $dompdf->set_option('enable_php', true);
            $dompdf->loadHtml($conteudo);
            $dompdf->setPaper('A4', $this->orientation);
            $dompdf->render();

            return $dompdf;
            //$dompdf->stream();
        //$dompdf->output();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function rotate()
    {
        $this->orientation = 'landscape';

        return $this;
    }

    public function download($name = null)
    {
        $filename = $name ?? time().'pdf';

        return $this->generate()->stream($filename, ['Attachment' => true]);
    }

    public function print()
    {
        return $this->generate()->stream(time().'.pdf', ['Attachment' => false]);
    }

    public function save($name = null)
    {
        $output = $this->generate()->output();
        $filename = $name ?? time().'pdf';
        file_put_contents(storage_path('files/docs/'.$filename), $output);

        return url('storage/files/docs/'.$filename);
    }

    public function values($arr = [])
    {
        $this->values = array_merge($this->values, $arr);

        return $this;
    }

    public function themed($titulo = '')
    {
        $this->titulo = html_entity_decode($titulo);
        $this->themed = true;

        return $this;
    }

    public function get_template($msg, $titulo)
    {
        if ($this->themed == false) {
            return $msg;
        }
        $msg = view('email.geral', [
            'user' => Auth::user(),
            'titulo' => $titulo,
            'conteudo' => $msg,
        ])->render();

        return $msg;
    }
}
