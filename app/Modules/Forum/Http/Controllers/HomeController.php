<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;

class HomeController extends ForumController
{
    public function index()
    {
        $dynamics = Dynamic::with(['topic', 'userInfo'])->paginate(15);

        return $this->view('forum::index', compact('dynamics'));
    }
}
