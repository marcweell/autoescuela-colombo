<?php

namespace App\Services\pdf;
 

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

interface IPDFService {
 

    public function table($table); 

    public function content($content);

    public function generate();
    
    public function save();

    public function rotate();

    public function download($name = null);

    public function print();    



}
