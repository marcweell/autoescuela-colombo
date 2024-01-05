<?php

namespace Flores;

use App\Services\page_info\Page_infoServiceQueryImpl;



class HomePageInfo
{
    private $info = [];
    private static $instance = null;

    private function __construct()
    {
        $infos = (new Page_infoServiceQueryImpl())->findAll();

        foreach ($infos as $key => $value) {

            if (!empty($value->extra)) {
                $value->extra = json_decode($value->extra);
                foreach ($value->extra as $i => $o) {
                    $value->{$o->code} = $o;
                }
            }

            if ($value->multiple == true) {

                $child = (new Page_infoServiceQueryImpl())->byParentId($value->id)->findAll() ?? [];

                foreach ($child ?? [] as $y => $val) {
                    if (!empty($val->extra)) {
                        $val->extra = json_decode($val->extra);
                    }else{
                        $val->extra = $value->extra;
                    }
                    $child[$y]->extra = $val->extra ?? $value->extra;
                    foreach ($val->extra as $i => $o) {
                        $val->{$o->code} = $o;
                    }
                }

                $this->info[$value->code] = $child;
                continue;
            }
            $this->info[$value->code] = $value->content;
        }
    }

    public static function getInstance()
    {

        if (HomePageInfo::$instance == null) {
            HomePageInfo::$instance = new HomePageInfo();
        }

        return HomePageInfo::$instance;
    }

    public function get($key = "")
    {
        if (empty(HomePageInfo::$instance->info[$key])) {
            return "";
        }

        return  HomePageInfo::$instance->info[$key];
    }
}
