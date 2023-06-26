<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\Forum\Http\Controllers\ForumController;
use Illuminate\Support\Facades\View;

class UserModuleController extends ForumController
{
    public function getUserMenus()
    {
        $user_menus = [
            [
                'menu_id' => 1,
                'menu_name' => '概览',
                'menu_icon' => 'fa-tachometer',
                'menu_view' => 'user::user.index',
                'permission' => true,
            ],
            [
                'menu_id' => 2,
                'menu_name' => '动态',
                'menu_icon' => 'fa-tags',
                'menu_view' => 'user::user.dynamics',
                'permission' => true,
            ],
            [
                'menu_id' => 3,
                'menu_name' => '评论',
                'menu_icon' => 'fa-comments',
                'menu_view' => 'user::user.comments',
                'permission' => true,
            ],
            [
                'menu_id' => 4,
                'menu_name' => '关注',
                'menu_icon' => 'fa-users',
                'menu_view' => 'user::user.follows',
                'permission' => true,
            ],
            [
                'menu_id' => 5,
                'menu_name' => '粉丝',
                'menu_icon' => 'fa-group',
                'menu_view' => 'user::user.fans',
                'permission' => true,
            ],
            [
                'menu_id' => 6,
                'menu_name' => '收藏',
                'menu_icon' => 'fa-heartbeat',
                'menu_view' => 'user::user.collections',
                'permission' => true,
            ],
            [
                'menu_id' => 7,
                'menu_name' => '日志',
                'menu_icon' => 'fa-newspaper-o',
                'menu_view' => 'user::user.logs',
                'permission' => false,
            ],
        ];
        View::share('user_menus', array_column($user_menus, null, 'menu_id'));
    }
}
