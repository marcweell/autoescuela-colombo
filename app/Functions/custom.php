<?php
use Flores\HomePageInfo;
use Flores\Tools;
use Flores\FileManager;
use Illuminate\Support\Carbon;


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


function _info($key)
{
    return HomePageInfo::getInstance()->get($key);
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
