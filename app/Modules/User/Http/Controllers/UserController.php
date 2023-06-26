<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Entities\User;
use App\Modules\User\Entities\UserInfo;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends UserModuleController
{
    public function users()
    {
        $userInfos = UserInfo::paginate(4);
        return view('user::users', compact('userInfos'));
    }

    public function show($user_id, Request $request)
    {
        // 设置会员的菜单栏
        $this->getUserMenus();

        $user_menu_id = $request->input('user_menu', 1);

        $userInfo = UserInfo::find($user_id);
        return view('user::show', compact('userInfo', 'user_menu_id'));
    }
}
