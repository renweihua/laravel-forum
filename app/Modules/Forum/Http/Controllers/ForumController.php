<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Topic\Entities\Topic;

class ForumController extends Controller
{
    protected $template = 'larabbs';

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
        // 话题列表
        $topics = Topic::getAllTopics();
        view()->share(compact('menus', 'topics'));
    }

    public function view($view, $data = [])
    {
        $template = $this->template;
        // 设置模板主题
        if ($template){
            $needle = '::';
            // 先获取字符串第一次出现的位置（ strpos() ）
            // 获取需替换字符长度（ strlen() ）
            // 替换字符
            $view = substr_replace($view, $needle . $template . '.', strpos($view, $needle),strlen($needle));
        }
        return view($view, $data);
    }
}
