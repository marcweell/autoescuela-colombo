<?php
namespace App\Services\page;

use stdClass;



interface IPageService {

    /**
    * @throws Exception
    */
    function update(stdClass $data);
}
