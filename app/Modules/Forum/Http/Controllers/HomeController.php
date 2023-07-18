<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\User\Entities\User;
use Illuminate\Http\Request;

class HomeController extends ForumController
{
    public function index(Request $request, User $user)
    {
        $tab = $request->input('tab', 'default');
        $search = $request->input('q', '');

        $dynamics = Dynamic::public()
            ->filter($request->all())
            ->with(['topic', 'userInfo'])
            ->paginate(15);

        return view('forum::index', compact('dynamics', 'tab', 'search'));
    }
}
