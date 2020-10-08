<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    protected $page_uid;

    public function __construct()
    {
        $this->page_uid = md5(\Request::fullUrl());
    }

    public function index()
    {
        return view('pages.index');
    }

    public function add()
    {
        return view('pages.add', ['page_uid' => $this->page_uid]);
    }

    public function get()
    {
        return view('pages.get', ['page_uid' => $this->page_uid]);
    }


}
