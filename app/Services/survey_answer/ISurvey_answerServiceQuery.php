<?php
namespace App\Services\survey_answer;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ISurvey_answerServiceQuery {

    /**
     * @return array
     * @throws \Exception
    */

    function findAll();

    /**
     * @return stdClass
     * @throws \Exception
    */
    function findById($id);
    /**
     * @return stdClass
     * @throws \Exception
    */
    function findByCode($id);
}
