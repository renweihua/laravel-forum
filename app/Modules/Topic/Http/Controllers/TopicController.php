<?php

namespace App\Modules\Topic\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Entities\Friendlink;
use App\Modules\Topic\Entities\Topic;
use App\Modules\User\Entities\User;
use App\Modules\User\Entities\UserAuth;
use App\Modules\User\Entities\UserInfo;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends TopicModuleController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $topics = $this->topics;

        $login_user_id = getLoginUserId();
        // 加载是否订阅
        $topics->load([
            'isFollow' => function($query) use ($login_user_id) {
                $query->where('user_id', $login_user_id);
            }
        ]);
        return view('topic::index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($topic_id, Request $request)
    {
        $login_user = Auth::user();
        if ($login_user){
            // 是否已签到
            $login_user->userInfo->is_sign = false;
            if ($login_user->userInfo->last_sign_time > 0 && date('Y-m-d') == date('Y-m-d', $login_user->userInfo->last_sign_time)){
                $login_user->userInfo->is_sign = true;
            }
        }
        $login_user_id = $login_user->user_id ?? 0;

        $topic = Topic::with([
            'isFollow' => function($query) use ($login_user_id) {
                $query->where('user_id', $login_user_id);
            }
        ])->find($topic_id);
        if (empty($topic)){
            abort(404, '话题不存在或已删除！');
        }

        // 是否已关注
        $topic->is_follow = $login_user_id == 0 ? false : ($topic->isFollow ? true : false);

        $tab = $request->input('tab', 'default');

        $dynamics = Dynamic::public()
            ->filter($request->all())
            ->where('topic_id', $topic_id)
            ->with([
                'userInfo',
                'topic',
                'isPraise' => function($query) use ($login_user_id) {
                    $query->where('user_id', $login_user_id);
                },
                'isCollection' => function($query) use ($login_user_id) {
                    $query->where('user_id', $login_user_id);
                },
            ])
            ->orderBy('dynamic_id', 'DESC')
            ->paginate(10);

        foreach ($dynamics as $dynamic){
            // 是否已赞
            $dynamic->is_praise = $login_user_id == 0 ? false : ($dynamic->isPraise ? true : false);
            // 是否已收藏
            $dynamic->is_collection = $login_user_id == 0 ? false : ($dynamic->isCollection ? true : false);
        }

        return view('topic::detail', compact('topic', 'dynamics', 'tab', 'login_user'));
    }
}
