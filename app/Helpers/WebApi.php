<?php

namespace Flores;
/**
 * Make JSON responses for Webapi.js
 */
class WebApi
{
    private $intent = [];
    private $headers = [];
    private $title = null;
    private $files = [];
    private $success = false;
    private $request_after_request;
    private $requires = [];
    private $statusCode = 200;

    private $data = [];

    private $statuses = ['0', '100', '101', '102', '122', '201', '202', '203', '204', '205', '206', '207', '300', '301', '302', '303', '304', '305', '306', '307', '308', '400', '401', '402', '403', '404', '405', '406', '407', '408', '409', '410', '411', '412', '413', '414', '415', '416', '417', '418', '422', '423', '424', '425', '426', '429', '450', '499', '500', '501', '502', '503', '504', '505'];

    public function __construct()
    {
        $this->request_after_request = new \stdClass();
    }

    public function intercept($requests = [], $vars = [], $callback = null)
    {
    }

    public function add($data, $key = null)
    {
        if ($key == null) {
            array_push($this->data, $data);
            return $this;
        }
        $this->data[$key] = $data;
        return $this;
    }
    public function count()
    {
        return count($this->intent);
    }

    public function setSuccess($success = true)
    {
        $this->success = $success;
        return $this;
    }


    public function setTitle($title = null)
    {
        $this->title = $title;
        return $this;
    }
    public function setStatusCode($statuscode = 200)
    {
        if (!in_array($statuscode, $this->statuses)) {
            return $this;
        }
        if ($statuscode === 0) {
            return $this;
        }
        $this->statusCode = $statuscode;
        return $this;
    }



    public function process_table($selector, $url, $cols, $payload, $timeout = 500, $async = false)
    {

        $arr = [
            'type' => 'process_table',
            'selector' => $selector,
            'url' => $url,
            'columns' => $cols,
            'payload' => $payload,
            'timeout' => $timeout,
            'async' => $async,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function setAttr(
        $content = '',
        $selector = '.profile',
        $name = 'src',
        $timeout = 0,
        $async = false
    ) {
        $arr = [
            'type' => 'set',
            'selector' => $selector,
            'name' => $name,
            'timeout' => $timeout,
            'async' => $async,
            'content' => $content,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function download(
        $url = '',
        $name = null,
        $prompt = false,
        $timeout = 0,
        $async = false
    ) {
        if ($name == null) {
            $tmp_name = str_replace('\\', '/', $url);
            $tmp_name = explode('/', $tmp_name);
            $name = $tmp_name[array_key_last($tmp_name)];
        }
        $arr = [
            'type' => 'download',
            'url' => $url,
            'name' => $name,
            'prompt' => (bool) $prompt,
            'timeout' => $timeout,
            'async' => $async,
        ];

        array_push($this->intent, $arr);

        return $this;
    }
    /**
     * 
     * 
     * @param $to = document|modal|moda-sm
     * 
     */
    public function print(
        $str = '',
        $to = 'document',
        $timeout = 0,
        $selector = '#page-content',
        $async = false
    ) {
        $arr = [
            'type' => 'print',
            //'identifier' => sha1(count($this->intent) + 1),
            'timeout' => $timeout,
            'async' => $async,
            'content' => $str,
            'to' => $to,
        ];

        if (!is_null($selector)) {
            $arr['selector'] = $selector;
        }

        array_push($this->intent, $arr);

        return $this;
    }

    public function append(
        $str = '',
        $selector = null,
        $timeout = 0,

        $async = false
    ) {
        $arr = [
            'type' => 'append',
            //'identifier' => sha1(count($this->intent) + 1),
            'timeout' => $timeout,
            'content' => $str,
            'async' => $async,
        ];

        if (!is_null($selector)) {
            $arr['selector'] = $selector;
        }

        array_push($this->intent, $arr);

        return $this;
    }

    public function notify(
        $str,
        $timeout = 0,

        $async = false,
        $lifetime = 5000
    ) {
        $arr = [
            'type' => 'notify',
            //'identifier' => sha1(count($this->intent) + 1),
            'timeout' => $timeout,
            'async' => $async,
            'content' => $str,
            'lifetime' => $lifetime,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function notifyLi(
        $data = [],
        $timeout = 0,

        $async = false,
        $lifetime = 5000
    ) {
        $arr = [
            'type' => 'notifyLi',
            //'identifier' => sha1(count($this->intent) + 1),
            'timeout' => $timeout,
            'async' => $async,
            'lifetime' => $lifetime,
            'content' => $data,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function alert(
        $str,
        $timeout = 0,
        $async = false,
        $lifetime = 5000
    ) {
        /* 
        if (str_starts_with($str,"EXPLODE[")) {
            $flag = explode("]",$str)[0];
            $flag = substr($flag,strpos($flag,"[")+1);
            $flag = trim($flag); 


            return $this->alertLi(explode($flag,substr($str,strpos($str,"]")+1)),$timeout,$async,$lifetime);
        } */

        $arr = [
            'type' => 'alert',
            //'identifier' => sha1(count($this->intent) + 1),
            'timeout' => $timeout,
            'async' => $async,
            'content' => $str,
            'lifetime' => $lifetime,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function alertLi(
        $data = [],
        $timeout = 0,
        $async = false,
        $lifetime = 5000
    ) {
        $arr = [
            'type' => 'alertLi',
            //'identifier' => sha1(count($this->intent) + 1),
            'timeout' => $timeout,
            'async' => $async,
            'lifetime' => $lifetime,
            'content' => $data,
        ];

        array_push($this->intent, $arr);

        return $this;
    }


    public static $CONTENT_TYPE_JAVASCRIPT = "application/javascript";
    public static $CONTENT_TYPE_CSS = "text/css";

    public function require(
        $url,
        $force = false,
        $contentType = "application/javascript",
        $encode_rounds = 1
    ) {

        $arr = [
            'url' => base64_encode($url),
            'token' => Tools::encode($url, $encode_rounds),
            'force' => $force,
            'content-type' => $contentType
        ];

        array_push($this->requires, $arr);

        return $this;
    }

    public function try(
        $url,
        $payload = [],
        $process = true,
        $async = false,
        $timeout = 0,
        $lifetime = 5000
    ) {
        $arr = [
            'type' => 'try',
            //'identifier' => sha1(count($this->intent) + 1),
            'timeout' => $timeout,
            'async' => $async,
            'lifetime' => $lifetime,
            'payload' => $payload,
            'url' => $url,
            'process' => $process,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function execute(
        $command = '',
        $timeout = 0,
        $async = false
    ) {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => $command,
            'async' => $async,
            'timeout' => $timeout,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function redirect(
        $url = './',
        $timeout = 0,
        $async = false
    ) {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'redirect',
            'redirect_url' => $url,
            'async' => $async,
            'timeout' => $timeout,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function reload(
        $timeout = 0,
        $async = false
    ) {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'reload',
            'async' => $async,
            'timeout' => $timeout,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function refresh(
        $timeout = 0,
        $async = false
    ) {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'refresh',
            'async' => $async,
            'timeout' => $timeout,
        ];

        array_push($this->intent, $arr);

        return $this;
    }

    public function save($timeout = 0, $async = false)
    {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'save',
            'timeout' => $timeout,
            'async' => $async,
        ];
        array_push($this->intent, $arr);

        return $this;
    }

    public function listen($timeout = 0, $async = false)
    {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'listen',
            'timeout' => $timeout,
            'async' => $async,
        ];
        array_push($this->intent, $arr);

        return $this;
    }

    public function resync($timeout = 0, $async = false)
    {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'resync',
            'timeout' => $timeout,
            'async' => $async,
        ];
        array_push($this->intent, $arr);

        return $this;
    }

    public function close_modal($timeout = 0, $async = false)
    {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'hide_dialog',
            'timeout' => $timeout,
            'async' => $async,
        ];
        array_push($this->intent, $arr);

        return $this;
    }

    public function clean_url($timeout = 0, $async = false)
    {
        $arr = [
            'type' => 'execute',
            //'identifier' => sha1(count($this->intent) + 1),
            'command' => 'clean_url',
            'timeout' => 0,
        ];
        array_push($this->intent, $arr);

        return $this;
    }

    public function cache($timeout = 0, $async = false)
    {
        $arr = [
            'type' => 'execute',
            //'identifier' => (count($this->intent) + 1),
            'command' => 'cache',
            'timeout' => $timeout,
            'async' => $async,
        ];
        array_push($this->intent, $arr);

        return $this;
    }
    // End Executes

    public function headers($arr = [])
    {
        $this->headers = $arr;
    }
    public function process_response()
    {

        if (!empty($this->request_after_request->url)) {
            array_push($this->intent, [
                'type' => 'request_after_request',
                'data' => $this->request_after_request->data,
                'url' => $this->request_after_request->url,
            ]);
        }
        $arr = [
            'time' => time(),
            //'token' => csrf_token(),
            'success' => $this->success,
            //'headers' => $this->headers,
            //'driver' => 'web-api',
            'require' => $this->requires,
            'data' => [
                'title' => $this->title,
                'intent' => $this->intent,
                //'intent_count' => $this->count(),
            ],
            //'ignore' => [],
        ];
        
        $arr = array_merge($arr,$this->data);
        if (empty($this->title)) {
            //   unset($arr['data']['title']);
        }


        return $arr;
    }

    public function get()
    {
        return response()->json($this->process_response(), $this->statusCode, $this->headers);
    }

    public function toString()
    {
        return json_encode($this->process_response());
    }

    public function echo()
    {
        echo json_encode($this->process_response());
    }
    //RESTY
}
