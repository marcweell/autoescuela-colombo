<?php

namespace App\Services\pdf;

use App\Services\pdf\IPDFService;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Auth;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
class MPdfServiceImpl implements IPDFService
{
    private $table;
    private $user = null;
    private $values = [];
    private $themed = false;
    private $titulo = '';
    private $content = '';
    private $options =  [
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font_size' => 0,
        'default_font' => '',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 16,
        'margin_bottom' => 16,
        'margin_header' => 9,
        'margin_footer' => 9,
        'orientation' => 'P',
    ];

    public function __construct()
    {
        $this->options['tempDir'] = storage_path('files/cache');
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

    public function generate(): Mpdf
    {
        ini_set('pcre.backtrack_limit', '5000000');
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
                $conteudo = html_entity_decode($conteudo);
            }
            $mpdf = new \Mpdf\Mpdf($this->options); 
            $mpdf->setFooter('{PAGENO}');
            
            $mpdf->WriteHTML($conteudo);

            return $mpdf;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function rotate()
    {
        $this->options['orientation'] = $this->options['orientation'] == 'L' ? 'P' : 'L';

        return $this;
    }

    public function download($name = null)
    {
        $filename = $name ?? 'file_' . time()  . '.pdf';
        return $this->generate()->Output($filename,storage_path('files/docs/'));//'D');
    }

    public function print()
    {
        return $this->generate()->Output();
    }

    public function save($name = null)
    {
        $filename = $name ?? 'PDF-FILE-' . time().pinCode(12);
        $this->generate()->Output(storage_path('files/docs/' . $filename.'.pdf'), 'F');
        return url('storage/files/docs/' . $filename.'.pdf');
    }
    public function toString($name = null)
    {
        return $this->generate()->output();
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
}
