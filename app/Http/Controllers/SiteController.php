<?php

namespace App\Http\Controllers;


class SiteController extends Controller
{
    /**
     * main page on frontend
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }
}
