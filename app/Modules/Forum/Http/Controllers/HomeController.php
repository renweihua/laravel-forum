<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;

class HomeController extends ForumController
{
    public function index()
    {
        $dynamics = Dynamic::paginate(15);
        return view('forum::index', compact('dynamics'));
    }
}
