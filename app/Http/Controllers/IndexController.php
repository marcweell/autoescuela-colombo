<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        return view('main.pages.index', [
        ])->render();
    }
    public function contactIndex(Request $request)
    {
        return view('main.pages.contact', [
        ])->render();
    }
    public function aboutIndex(Request $request)
    {
        return view('main.pages.about', [
        ])->render();
    }


    public function faqIndex(Request $request)
    {
        return view('main.pages.faq', [
        ])->render();
    }
    public function termsIndex(Request $request)
    {

        return view('main.pages.terms', [
        ])->render();
    }
    public function privacyIndex(Request $request)
    {
        return view('main.pages.privacy', [
        ])->render();
    }

}
