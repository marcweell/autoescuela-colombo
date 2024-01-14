<?php

namespace App\Services\wallet;

use App\Services\exchange_rate\Exchange_rateServiceImpl;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class WalletServiceQueryImpl implements IWalletServiceQuery
{

    private $table =  'wallet';
    
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->leftJoin('user', 'user.id', $this->table . '.user_id')
        ->leftJoin('company', 'company.id', $this->table . '.company_id')
        ->leftJoin('currency', 'currency.id', $this->table . '.currency_id')
        ->select(
            $this->table . '.*',
            'user.code as user_code',
            'company.name as company_name',
            'currency.name as currency_name',
            'currency.code as currency_code',
            'currency.symbol as currency_symbol',
            'user.profile_picture as user_profile_picture',
            DB::raw('concat(user.name," ",user.last_name) as user_full_name')
        );
    }


    public function where($value,$key = 'id'){
        $this->query->where($key,$value);
        return $this;
    }

    public function deleted($bool = true)
    {
        if ($bool==true) {
            $this->query->where($this->table . '.deleted_at','!=',null);
        }else {
            $this->query->where($this->table . '.deleted_at',null);
        }
        return $this;
    }  
    public function active($bool = true)
    {
        // $this->query->where($this->table . '.active',$bool);
        return $this;
    }  
    public function exclude(array $ids)
    {
        $this->query->whereNotIn($this->table . '.id',$ids);
        return $this;
    }  
    
    public function primary($bool = true)
    {
        $this->query->where($this->table . '.primary_wallet',$bool);
        return $this;
    }  

    public function byUserId($id)
    {
            $this->query->where($this->table . '.user_id',$id);
        return $this;
    }  

    public function orderDesc()
    {
        $this->query->orderByDesc($this->table . '.created_at');
        return $this;
    }
 
    public function findAll()
    {
        return $this->query->get();
    }
 
    public function find()
    {
        return $this->query->first();
    }

    public function findById($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }
 
        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        } 
 
        return $this->query->where($this->table . '.id', $id)->first();
    }
    public function findByCode($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }
        
        return $this->query->where($this->table . '.code', $id)->first();
    } 

    public function getTotalBalance($user_id)
    {
        $balance = 0;
        $wallet = new \stdClass();

        $wallets = $this->byUserId($user_id)->findAll();

        foreach ($wallets??[] as $key => $value) {

            $wallet = empty($wallet->id) ? $value : $wallet;

            if ($wallet->currency_id  == $value->currency_id) {
                $total = $value->balance;
            }else{
                $total = (new Exchange_rateServiceImpl())->convert($value->balance, $value->currency_id, $wallet->currency_id);
            }

            $balance = $balance + $total;
        }

        return (empty($wallet->id) ? "" : $wallet->currency_symbol) .' '.  number_format($balance);
    }
}
