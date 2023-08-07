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
        $login_user = getLoginUser();

        return view('forum::functions', compact('login_user'));
    }

    public function getFunctions()
    {
        return file_get_contents(base_path() . '/功能列表.md');
    }
}
