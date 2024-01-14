<?php

namespace App\Services\wallet;

use Flores;
use stdClass;
use Flores\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\auth\AuthServiceImpl;


use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use hisorange\BrowserDetect\Parser as Browser;
use App\Services\wallet\WalletServiceQueryImpl;
use Illuminate\Support\Facades\Request as FacadesRequest;


/** @author Nelson Flores | nelson.flores@live.com */

class WalletServiceImpl implements IWalletService
{
    private $insertFillables = ['tag', 'type', 'code', "qrcode", 'balance', 'primary_wallet', 'currency_id',   'payment_token', 'user_id', 'company_id'];
    private $updateFillables = ['tag', 'type', 'auto_debt', "qrcode", 'balance',  'primary_wallet', 'currency_id', 'payment_token', 'user_id', 'company_id'];


    private $table =  'wallet';
    private $serviceQuery;

    public function __construct()
    {
        $this->serviceQuery = new WalletServiceQueryImpl();
    }
    private function getWalletCode($user_id)
    {

        $arr = [];
        $numbers = '01234567890';

        foreach (str_split($numbers) as $key => $value) {
            for ($i = 0; $i < 4; $i++) {
                array_push($arr, $value);
            }
        }

        shuffle($arr);

        $numbers = implode("", $arr);

        $n1 = pinCode(6, $numbers);
        $n2 = substr(time(), 0, 10);

        return $n1 . $n2;
    }

    public function add($data)
    {
        $data->type = empty($data->type) ? "currency" : $data->type;


        if (empty($data->currency_id) and $data->type == "currency") {
            throw new \Exception(__('Moeda invalida'), 400);
        }

        if (empty($data->user_id)) {
            throw new \Exception(__('Usuario invalido'), 400);
        }

        $payload = new stdClass();

        $data->code = $this->getWalletCode($data->user_id);

        $data->tag = empty($data->tag) ? ($data->type == "unity" ? "UNIT" : "") . "CARD" . pinCode(4) : $data->tag;

        $data->payment_token = code(null, $data->code);

        $data->primary_wallet = !empty($data->primary_wallet);

        $name = code(null, $data->user_id) . ".png";

        $content = json_encode([
            "uid" => $data->user_id,
            "wlt" => $data->code,
            'tkn' => $data->payment_token,
        ]);

        QrCode::size(500)->format('png')->merge("/public/assets/images/qr-logo.png", 0.24)->generate($content, storage_path("files/qrcodes/" . $name));


        $data->qrcode = tools()->fileTobase64("storage/files/qrcodes/" . $name);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $wallet = $this->serviceQuery->findByCode($data->code);

        if (!empty($wallet->id)) {
            throw new \Exception(__('Codigo invalido'), 400);
        }


        $arr = json_decode(json_encode($payload), true);

        DB::table($this->table)->insert($arr);


        if (!empty($payload->primary_wallet)) {
            DB::table("wallet")->where("code", "!=", $data->code)->where("user_id", $data->user_id)->update(["primary_wallet" => false]);
        }
    }

    public function updateQrCode($id)
    {

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }


        $data = $this->serviceQuery->findById($id);

        if (empty($data->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        $name = code(null, $data->user_id) . ".png";

        $data->payment_token = code(null, $data->code);


        $content = json_encode([
            "uid" => $data->user_id,
            "wlt" => $data->code,
            'tkn' => $data->payment_token,
        ]);

        QrCode::size(500)->format('png')->merge("/public/assets/images/qr-logo.png", 0.24)->generate($content, storage_path("files/qrcodes/" . $name));


        $data->qrcode = tools()->fileTobase64("storage/files/qrcodes/" . $name);


        $payload = new stdClass();

        foreach ($data as $i => $value) {
            if (in_array($i, ["qrcode", 'payment_token'])) {
                $payload->{$i} = $value;
            }
        }

        $arr = json_decode(json_encode($payload), true);

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }


    public function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        $data->primary_wallet = !empty($data->primary_wallet);
        $data->auto_debt = !empty($data->auto_debt);

        $payload = new stdClass();

        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }

        $wallet = $this->serviceQuery->findById($data->id);

        if (empty($wallet->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }


        $arr = json_decode(json_encode($payload), true);

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);

        if (!empty($payload->primary_wallet)) {
            DB::table("wallet")
                ->where("id", "!=", $wallet->id)
                ->where("user_id", $wallet->user_id)
                ->update(["primary_wallet" => false]);
        }
    }
    public function recharge($data)
    {
        if (empty($data->id) or empty($data->amount)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }


        $payload = new stdClass();

        $wallet = $this->serviceQuery->findById($data->id);
        if (empty($wallet->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        $data->amount = $data->amount + $wallet->balance;

        $arr =  [
            'balance' => $data->amount
        ];

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }
    public function trash($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => DB::raw('now()')]);
    }
    public function restore($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => null]);
    }
    public function delete($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        return $this->trash($id);

        //DB::table($this->table)->where($this->table . '.id', $id)->delete();
    }
}
