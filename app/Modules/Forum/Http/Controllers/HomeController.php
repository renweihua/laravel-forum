<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\User\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends ForumController
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'default');
        $search = $request->input('q', '');

        $dynamics = Dynamic::public()
            ->filter($request->all())
            ->with(['topic', 'userInfo'])
            ->paginate(15);

        $login_user = Auth::user();
        if ($login_user){
            // 是否已签到
            $login_user->userInfo->is_sign = false;
            if ($login_user->userInfo->last_sign_time > 0 && date('Y-m-d') == date('Y-m-d', $login_user->userInfo->last_sign_time)){
                $login_user->userInfo->is_sign = true;
            }
        }

        return view('forum::index', compact('dynamics', 'tab', 'search', 'login_user'));
    }
}
