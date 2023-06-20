<?php

namespace App\Modules\Forum\Http\Controllers;

class HomeController extends ForumController
{
    public function index()
    {
        return view('forum::test');
    }
}
