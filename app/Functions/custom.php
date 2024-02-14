<?php

use App\Security\Permission\PermissionHandler;
use Flores\HomePageInfo;
use Flores\Tools;
use Flores\FileManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

function tools()
{
    return new Tools();
}


function fileman($file = null)
{
    return new FileManager($file);
}


/**
 * Get Request IP Address
 */
function getIp()
{
    foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }

    return request()->ip();
}

/**
 * Generate Content Code
 * @param string $code
 * @param string $concat
 * @param bool $overwrite
 * @return string
 */
function code($code = null, $concat = "", bool $overwrite = false)
{
    if (!empty($code) and $overwrite == false) {
        return $code;
    }

    $concat = is_countable($concat) ? $concat : $concat;
    $cookie = json_encode($_COOKIE) ?? "";
    $server = json_encode($_SERVER) ?? "";

    $generated = sha1($concat . pinCode(200) . time() . ($code ?? "") . $cookie . $server);

    return Tools::give_space(strtolower($generated), 11, "-");
}

function pinCode($size = 5, $chars = '012OPQRSTUV34ABCDZ56EFGHIJKLMN789WXY')
{

    if ($size > strlen($chars)) {
        $size = strlen($chars);
    }

    $arr = str_split($chars);
    shuffle($arr);
    $code = substr(implode("", $arr), 0, $size);

    return $code;
}


function _info($key, $alt = "")
{
    $val = HomePageInfo::getInstance()->get($key);
    return empty($val) ? $alt : $val;
}


function isDate($value)
{
    if (empty($value)) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function getSystemTzOffset($user = null)
{
    $timezone = SERVER_TIMEZONE;

    $currentDateTime = Carbon::now($timezone);
    $offset = $currentDateTime->offsetHours;
    $signal = "-";

    if ($offset > 0) {
        $signal = "+";
    }

    $offset = abs($offset);

    $offset = $signal . str_pad($offset, 2, '0', STR_PAD_LEFT) . ":00";

    return $offset;
}

function getTzOffset()
{
    $offset = null;


    if ($offset == null) {
        $currentDateTime = Carbon::now(date_default_timezone_get());
        $offset = $currentDateTime->offsetHours;
    }


    $signal = "-";

    if ($offset > 0) {
        $signal = "+";
    }

    $offset = abs($offset);
    $offset = $signal . str_pad($offset, 2, '0', STR_PAD_LEFT) . ":00";

    return $offset;
}

/**
 * Makes http response
 * @author  Nelson Flores
 */
function hh($code, $msg = null)
{
    $error =
        [
            '0' => 'Erro de Conexao! Verifique a sua rede...',
            '100' => 'Continuar',
            '101' => 'Mudando protocolos',
            '102' => 'Processamento',
            '122' => 'Pedido-URI muito longo',
            '201' => 'Criado',
            '202' => 'Aceito',
            '203' => 'não-autorizado',
            '204' => 'Nenhum conteúdo',
            '205' => 'Reset',
            '206' => 'Conteúdo parcial',
            '207' => 'Status Multi',
            '300' => 'Múltipla escolha',
            '301' => 'Movido',
            '302' => 'Encontrado',
            '303' => 'Consulte Outros',
            '304' => 'Não modificado',
            '305' => 'Use Proxy',
            '306' => 'Proxy Switch',
            '307' => 'Redirecionamento temporário',
            '308' => 'Redirecionamento permanente',
            '400' => 'Requisição inválida',
            '401' => 'Não autorizado',
            '402' => 'Pagamento necessário',
            '403' => 'Proibido',
            '404' => 'Infelizmente, este conteúdo não está disponível neste momento',
            '405' => 'Método não permitido',
            '406' => 'Não Aceitável',
            '407' => 'Autenticação de proxy necessária',
            '408' => 'Tempo de requisição esgotou (Timeout)',
            '409' => 'Conflito geral',
            '410' => 'Gone',
            '411' => 'comprimento necessário',
            '412' => 'Pré-condição falhou',
            '413' => 'EntyearsOld de solicitação muito grande',
            '414' => 'Pedido-URI Too Long',
            '415' => 'Tipo de míday não suportado',
            '416' => 'Solicitada de Faixa Não Satisfatória',
            '417' => 'Falha na expectativa',
            '418' => 'Eu sou um bule de chá',
            '422' => 'EntyearsOld improcessável (WebDAV) (RFC 4918)',
            '423' => 'Fechado (WebDAV) (RFC 4918)',
            '424' => 'Falha de Dependência (WebDAV) (RFC 4918)',
            '425' => 'coleção não ordenada (RFC 3648)',
            '426' => 'Upgrade Obrigatório (RFC 2817)',
            '429' => 'pedidos em excesso',
            '450' => 'bloqueados pelo Controle de Pais do Windows',
            '499' => 'cliente fechou Pedido',
            '500' => 'Erro interno do servidor',
            '501' => 'Não implementado',
            '502' => 'Bad Gateway',
            '503' => 'Serviço indisponível',
            '504' => 'Gateway Time-Out',
            '505' => 'HTTP Version not supported',
        ];
    if ($msg == null) {
        $msg = isset($error[$code]) ? $error[$code] : null;
    }


    return response($msg, $code)->header('Content-Type', 'text/html');
}


/**
 * Checks User Permissions
 *
 * @param string $permission
 * @param bool $prefix - checks permissions tree
 *
 * @return bool
 * @author  Nelson Flores
 */
function scan($permission, $prefix = false)
{
    if ($prefix === true) {
        return PermissionHandler::getInstance()->checkPrefix($permission);
    }
    return PermissionHandler::getInstance()->check($permission);
}


/**
 * Checks if User has Permissions to acess route
 *
 * @param string $permission
 * @param bool $prefix - checks permissions tree
 * @return bool
 * @author  Nelson Flores
 */
function check_route($route, $prefix = false)
{
    $credencials = config("permissions");
    foreach (Route::getRoutes() as $i => $route_) {
        if (empty($credencials[$route_->getActionName()])) {
            continue;
        }
        if ($route_->getName() !== $route) {
            continue;
        }

        $credencial = $credencials[$route_->getActionName()];
        return scan($credencial['permission'], $prefix);
    }
    return true;
}


/**
 * Convert BornDate to Years Old
 * @param mixed $date
 * @return int
 *
 * @author  Nelson Flores
 */
function yearsOld($date)
{
    $month = date('m', strtotime($date));
    $year = date('Y', strtotime($date));
    $day = date('d', strtotime($date));
    $yearsOld = date('Y') - $year;

    if (date('m') <= $month && $day > date('d')) {
        --$yearsOld;
    }

    if ($yearsOld < 0) {
        $yearsOld = 0;
    }

    return $yearsOld;
}



