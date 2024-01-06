<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\faq\FaqServiceQueryImpl;
use App\Services\gallery\GalleryServiceQueryImpl;
use App\Services\site_menu\Site_menuServiceQueryImpl;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {

        $slider = _info('home.slider');
        return view('main.pages.index', [
            'slider'=>$slider,
            'site_menu'=>(new Site_menuServiceQueryImpl())->orderbyId()->findAll(),
            'faq'=>(new FaqServiceQueryImpl())->findAll(),
            'gallery'=>(new GalleryServiceQueryImpl())->limit(12)->findAllShuffle()
        ])->render();
    }
    public function contactIndex(Request $request)
    {
        return view('main.pages.contact', [
            'site_menu'=>(new Site_menuServiceQueryImpl())->orderbyId()->findAll(),
            'faq'=>(new FaqServiceQueryImpl())->findAll(),
            'gallery'=>(new GalleryServiceQueryImpl())->limit(12)->findAllShuffle()
        ])->render();
    }
    public function aboutIndex(Request $request)
    {
        return view('main.pages.about', [
            'site_menu'=>(new Site_menuServiceQueryImpl())->orderbyId()->findAll(),
            'faq'=>(new FaqServiceQueryImpl())->findAll(),
            'gallery'=>(new GalleryServiceQueryImpl())->limit(12)->findAllShuffle()
        ])->render();
    }


    public function faqIndex(Request $request)
    {
        return view('main.pages.faq', [
            'site_menu'=>(new Site_menuServiceQueryImpl())->orderbyId()->findAll(),
            'faq'=>(new FaqServiceQueryImpl())->findAll(),
            'gallery'=>(new GalleryServiceQueryImpl())->limit(12)->findAllShuffle()
        ])->render();
    }
    public function termsIndex(Request $request)
    {

        return view('main.pages.terms', [
            'site_menu'=>(new Site_menuServiceQueryImpl())->orderbyId()->findAll(),
            'faq'=>(new FaqServiceQueryImpl())->findAll(),
            'gallery'=>(new GalleryServiceQueryImpl())->limit(12)->findAllShuffle()
        ])->render();
    }
    public function privacyIndex(Request $request)
    {
        return view('main.pages.privacy', [
            'site_menu'=>(new Site_menuServiceQueryImpl())->orderbyId()->findAll(),
            'faq'=>(new FaqServiceQueryImpl())->findAll(),
            'gallery'=>(new GalleryServiceQueryImpl())->limit(12)->findAllShuffle()
        ])->render();
    }

}
