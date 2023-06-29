<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Comment\Entities\DynamicComment;
use App\Modules\User\Entities\User;
use App\Modules\User\Entities\UserAuth;
use App\Modules\User\Entities\UserInfo;
use App\Modules\User\Http\Requests\UserUpdateRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class UsersController extends UserModuleController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function users()
    {
        $userInfos = UserInfo::paginate(4);
        return view('user::users', compact('userInfos'));
    }

    public function show(UserAuth $user, Request $request)
    {
        $user->load('userInfo');

        $tab = $request->input('tab');
        if ($tab == 'replies'){
            $comments = DynamicComment::where('user_id', $user->user_id)->with('dynamic')->orderByDesc('comment_id')->paginate(10);
            View::share('comments', $comments);
        }else{
            $dynamics = Dynamic::where('user_id', $user->user_id)->with('userInfo')->orderByDesc('dynamic_id')->paginate(10);
            View::share('dynamics', $dynamics);
        }

        return $this->view('user::users.show', compact('user'));

        $userInfo = UserInfo::find($user_id);
        if (empty($userInfo)){
            abort(404, '会员不存在或已删除！');
        }

        // 设置会员的菜单栏
        $this->getUserMenus();

        $user_menu_id = $request->input('user_menu', 1);
        switch ($user_menu_id){
            case 1: // 主页
                break;
            case 2: // 动态
                $dynamics = Dynamic::where('user_id', $user_id)->with(['userInfo', 'topic'])->orderByDesc('dynamic_id')->paginate(10);
                View::share('dynamics', $dynamics);
                break;
        }
        return view('user::show', compact('userInfo', 'user_menu_id'));
    }

    public function edit(UserAuth $user)
    {
        $this->authorize('update', $user);
        return $this->view('user::users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, UserAuth $user)
    {
        $this->authorize('update', $user);
        $user->userInfo()->update($request->only('nick_name'));
        return redirect()->route('users.show', $user->user_id)->with('success', '个人资料更新成功！');
    }
}
