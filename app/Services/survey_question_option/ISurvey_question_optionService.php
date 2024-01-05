<?php
namespace App\Services\survey_question_option;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

interface ISurvey_question_optionService {

    /**
    * @throws \Exception
    */
    public function add(stdClass $data);
    /**
    * @throws \Exception
    */
    public function update(stdClass $data);
    /**
    * @throws \Exception
    */
    public function delete($id);
    /**
    * @throws \Exception
    */
    public function trash($id);
    /**
    * @throws \Exception
    */
    public function restore($id);
}
