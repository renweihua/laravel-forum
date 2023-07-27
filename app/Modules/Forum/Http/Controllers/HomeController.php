<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends ForumController
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'default');
        $search = $request->input('q', '');

        $login_user = getLoginUser();
        $login_user_id = $login_user->user_id ?? 0;
        if ($login_user){
            // 是否已签到
            $login_user->userInfo->is_sign = false;
            if ($login_user->userInfo->last_sign_time > 0 && date('Y-m-d') == date('Y-m-d', $login_user->userInfo->last_sign_time)){
                $login_user->userInfo->is_sign = true;
            }
        }

        $dynamics = Dynamic::public()
            ->filter($request->all())
            ->with([
                'topic',
                'userInfo',
                'isPraise' => function($query) use ($login_user_id) {
                    $query->where('user_id', $login_user_id);
                },
                'isCollection' => function($query) use ($login_user_id) {
                    $query->where('user_id', $login_user_id);
                },
            ])
            ->paginate(15);

        foreach ($dynamics as $dynamic){
            // 是否已赞
            $dynamic->is_praise = $login_user_id == 0 ? false : ($dynamic->isPraise ? true : false);
            // 是否已收藏
            $dynamic->is_collection = $login_user_id == 0 ? false : ($dynamic->isCollection ? true : false);
        }

        return view('forum::index', compact('dynamics', 'tab', 'search', 'login_user'));
    }

    // 功能列表
    public function functions()
    {
        return view('forum::functions');
    }

    public function getFunctions()
    {
        return file_get_contents(base_path() . '/功能列表.md');
    }
}
