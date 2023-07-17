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
use Illuminate\Support\Facades\Auth;
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

    public function show(User $user, Request $request)
    {
        $login_user_id = Auth::id();

        $user->load([
            'userInfo.isFollow' => function($query) use($login_user_id){
                $query->where('user_id', $login_user_id);
            }
        ]);
        // 是否已关注
        $user->userInfo->is_follow = $user->userInfo->isFollow ? true : false;

        $tab = $request->input('tab');
        if ($tab == 'replies'){
            $comments = DynamicComment::where('user_id', $user->user_id)->with(['dynamic.topic'])->orderByDesc('comment_id')->paginate(10);
            View::share('comments', $comments);
        }else{
            $dynamics = Dynamic::where('user_id', $user->user_id)->with(['userInfo', 'topic'])->orderByDesc('dynamic_id')->paginate(10);
            View::share('dynamics', $dynamics);
        }

        return view('user::users.show', compact('user'));
    }

    public function edit(UserAuth $user)
    {
        $this->authorize('update', $user);
        return view('user::users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, UserAuth $user)
    {
        $this->authorize('update', $user);
        $userInfo = $user->userInfo;
        $userInfo->nick_name = $request->input('nick_name');
        $basic_extends = $userInfo->basic_extends;
        // 简介/签名
        $user_introduction = $request->input('user_introduction');
        if ($user_introduction){
            $basic_extends['user_introduction'] = $user_introduction;
        }
        // 所在城市
        $location = $request->input('location');
        if ($location){
            $basic_extends['location'] = $location;
        }
        $userInfo->basic_extends = $basic_extends;
        $userInfo->save();

        return redirect()->route('users.show', $user->user_id)->with('success', '个人资料更新成功！');
    }
}
