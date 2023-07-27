<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Entities\UserLoginLog;
use App\Modules\User\Entities\UserSign;

class IndexController extends UserModuleController
{
    // 登录日志
    public function loginLogs()
    {
        $login_user = getLoginUser();
        $logs = UserLoginLog::where('user_id', $login_user->user_id)->orderByDesc('log_id')->paginate(10);
        return view('user::login_logs', compact('logs', 'login_user'));
    }

    // 签到日志
    public function signs()
    {
        $login_user = getLoginUser();
        $sign_logs = UserSign::where('user_id', $login_user->user_id)->orderByDesc('sign_id')->paginate(10);
        return view('user::signs.logs', compact('sign_logs', 'login_user'));
    }
}
