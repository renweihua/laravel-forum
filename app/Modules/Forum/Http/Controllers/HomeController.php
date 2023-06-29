<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\User\Entities\User;
use App\Modules\User\Entities\UserAuth;
use Illuminate\Http\Request;

class HomeController extends ForumController
{
    public function index(Request $request, User $user)
    {
        $tab = $request->input('tab', 'default');

        $dynamics = Dynamic::public()
            ->filter($request->all())
            ->with(['topic', 'userInfo'])
            ->paginate(15);

        // 活跃会员
        $active_users = $user->getActiveUsers();

        return $this->view('forum::dynamic.index', compact('dynamics', 'tab', 'active_users'));
    }
}
