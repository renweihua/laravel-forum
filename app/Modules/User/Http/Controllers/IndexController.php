<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Entities\UserSign;

class IndexController extends UserModuleController
{
    // 签到日志
    public function signs()
    {
        $login_user = getLoginUser();
        $sign_logs = UserSign::where('user_id', $login_user->user_id)->orderByDesc('sign_id')->paginate(10);
        return view('user::signs.logs', compact('sign_logs', 'login_user'));
    }
}
