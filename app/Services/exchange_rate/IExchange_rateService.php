<?php
namespace App\Services\exchange_rate;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

interface IExchange_rateService {

    /**
    * @throws \Exception
    */
    public function add(stdClass $data);
    /**
    * @throws \Exception
    */
    public function updateExchangeRates();
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
