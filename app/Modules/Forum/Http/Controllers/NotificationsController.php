<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Notify;
use App\Modules\Forum\Services\NotifyService;
use App\Modules\User\Entities\UserInfo;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends ForumController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $login_user_id = Auth::id();
        // 获取登录用户的所有通知
        $notifications = Notify::where('user_id', $login_user_id)
            ->with('sender')
            ->orderByDesc('notify_id')
            ->paginate(20);

        // 格式化结构
        NotifyService::format($notifications, $set_read_nums);

        // 扣除已读数量
        UserInfo::find($login_user_id)->decrement('notification_count', $set_read_nums);

        return view('forum::larabbs.notifications.index', compact('notifications'));
    }
}
