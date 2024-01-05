<?php
namespace App\Services\faq;

use stdClass;



interface IFaqService {

    /**
    * @throws Exception
    */
    function add(stdClass $data);
    /**
    * @throws Exception
    */
    function update(stdClass $data);
    /**
    * @throws Exception
    */
    function delete($id);
}
