<?php
namespace App\Services\auth;

use stdClass;
use Flores;




interface IAuthService {

    /**
    * @throws \Exception
    */
    public function login(stdClass $data);
    /**
    * @throws \Exception
    */
    public function logout();
    /**
    * @throws \Exception
    */
    public function recover(stdclass $data);
    /**
    * @throws \Exception
    */
    public function oAuthLogin($data);
    /**
    * @return Boolean
    */
    public function isLogged(); 
    /**
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser();
     
    
}
