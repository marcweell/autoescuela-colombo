<?php
namespace App\Services\page_info;

use stdClass;



interface IPage_infoService {
 
    /**
    * @throws Exception
    */
    function update(stdClass $data); 
}
