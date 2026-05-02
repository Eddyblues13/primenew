<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function products()
    {
        return view('frontend.products');
    }

    public function features()
    {
        return view('frontend.features');
    }

    public function markets()
    {
        return view('frontend.markets');
    }

    public function learn()
    {
        return view('frontend.learn');
    }

    public function company()
    {
        return view('frontend.company');
    }

    public function blogArticle($slug = null)
    {
        return view('frontend.blog-article');
    }
}
