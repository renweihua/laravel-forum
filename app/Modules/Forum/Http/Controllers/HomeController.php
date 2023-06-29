<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use Illuminate\Http\Request;

class HomeController extends ForumController
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'default');

        $dynamics = Dynamic::public()
            ->filter($request->all())
            ->with(['topic', 'userInfo'])
            ->paginate(15);

        return $this->view('forum::dynamic.index', compact('dynamics', 'tab'));
        return $this->view('forum::index', compact('dynamics'));
    }
}
