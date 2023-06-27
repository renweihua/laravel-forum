<?php

namespace App\Modules\Forum\Http\Controllers;

use Illuminate\Routing\Controller;

class ForumController extends Controller
{
    public function __construct()
    {
        // 临时设置菜单栏目
        $menus = [
            [
                'menu_name' => '首页',
                'menu_url' => '/',
                'menu_icon' => 'fa-home'
            ],
            [
                'menu_name' => '话题',
                'menu_url' => route('topics'),
                'menu_icon' => 'fa-tag'
            ],
            [
                'menu_name' => '多层级的',
                'menu_url' => '/topic',
                'menu_icon' => 'fa-tag',
                '_childs' => [
                    [
                        'menu_name' => '001',
                        'menu_url' => '/friendlinks',
                        'menu_icon' => 'fa-external-link-square'
                    ],
                    [
                        'menu_name' => '002',
                        'menu_url' => '/friendlinks',
                        'menu_icon' => 'fa-external-link-square'
                    ],
                    [
                        'menu_name' => '003',
                        'menu_url' => '/friendlinks',
                        'menu_icon' => 'fa-external-link-square'
                    ],
                    [
                        'menu_name' => '004',
                        'menu_url' => '/friendlinks',
                        'menu_icon' => 'fa-external-link-square'
                    ],
                ]
            ],
            [
                'menu_name' => '用户组',
                'menu_url' => '/user-group',
                'menu_icon' => 'fa-group'
            ],
            [
                'menu_name' => '友情链接',
                'menu_url' => '/friendlinks',
                'menu_icon' => 'fa-external-link-square'
            ]
        ];
        view()->share([
            'menus' => $menus
        ]);
    }
}
