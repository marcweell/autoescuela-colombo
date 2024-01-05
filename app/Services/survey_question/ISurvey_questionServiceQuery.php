<?php
namespace App\Services\survey_question;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ISurvey_questionServiceQuery {

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