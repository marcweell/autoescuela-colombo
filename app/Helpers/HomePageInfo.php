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
            if ($value->multiple == true) {
                $this->info[$value->code] = (new Page_infoServiceQueryImpl())->byParentId($value->id)->findAll() ?? [];
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
