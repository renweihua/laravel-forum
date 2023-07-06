<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Entities\DynamicCollection;
use App\Modules\Forum\Entities\DynamicPraise;
use App\Modules\Forum\Http\Requests\DynamicRequest;
use App\Modules\Topic\Entities\Topic;
use App\Modules\User\Entities\UserFollowFan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DynamicsController extends ForumController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function show(Request $request, $dynamic_id)
    {
        $login_user_id = Auth::id();
        $dynamic = Dynamic::with(['user', 'userInfo' => function($query) use($login_user_id){
            $query->with([
                'isFollow' => function($query) use ($login_user_id) {
                    $query->where('user_id', $login_user_id);
                }
            ]);
        }])->find($dynamic_id);
        if (empty($dynamic)){
            abort(404, '动态不存在或已删除！');
        }
        if ($dynamic->is_public == 0){
            abort(403, '动态不可访问！');
        }
        // URL 矫正
        if (!empty($dynamic->slug) && $dynamic->slug != $request->slug) {
            return redirect($dynamic->link(), 301);
        }
        if ($login_user_id){
            $dynamic->load([
                'isPraise' => function($query) use ($login_user_id) {
                    $query->where('user_id', $login_user_id);
                },
                'isCollection' => function($query) use ($login_user_id) {
                    $query->where('user_id', $login_user_id);
                },
            ]);
        }
        // 浏览量递增
        $dynamic->update(['cache_extends->reads_num' => $dynamic->cache_extends['reads_num'] + 1]);
        // 是否已赞
        $dynamic->is_praise = $login_user_id == 0 ? false : ($dynamic->isPraise ? true : false);
        // 是否已收藏
        $dynamic->is_collection = $login_user_id == 0 ? false : ($dynamic->isCollection ? true : false);
        // 是否关注
        $dynamic->userInfo->is_follow = $login_user_id == 0 ? false : ($dynamic->userInfo->isFollow ? true : false);
        // 是否为登录会员
        $dynamic->userInfo->is_self = $login_user_id == 0 ? false : ($dynamic->user_id == $login_user_id ? true : false);
        /**
         * 后续使用沉余字段
         */
        // 会员的动态数量
        $dynamic->user->dynamic_count = Dynamic::getDynamicsTotalByUser($dynamic->user_id);
        // 会员的粉丝数量
        $dynamic->user->fan_count = UserFollowFan::where('friend_id', $dynamic->user_id)->count();
        // 会员喜欢的动态数量
        $dynamic->user->praise_dynamic_count = DynamicPraise::where('user_id', $dynamic->user_id)->count();
        // 会员收藏的动态数量
        $dynamic->user->collection_dynamic_count = DynamicCollection::where('user_id', $dynamic->user_id)->count();

        return view('forum::dynamic.show', compact('dynamic', 'login_user_id'));
    }

    public function create(Dynamic $dynamic, Request $request)
    {
        $topic_id = $request->input('topic_id', 0);
        return view('forum::dynamic.create_and_edit', compact('dynamic', 'topic_id'));
    }

    public function store(DynamicRequest $request, Dynamic $dynamic)
    {
        // 限制可设置的字段
        $dynamic->fill($request->only('dynamic_title', 'dynamic_markdown', 'topic_id'));
        // 如果存在html，则赋值
        if ($request->has('editormd_id-html-code')){
            $dynamic->dynamic_content = $request->input('editormd_id-html-code');
        }
        $dynamic->user_id = Auth::id();
        // 默认内容的格式
        $dynamic->content_type = Dynamic::CONTENT_TYPE_MARKDOWN;
        // 仅支持`文章`类型
        $dynamic->dynamic_type = Dynamic::DYNAMIC_TYPE_ARTICLE;
        // 默认为已审核的
        $dynamic->is_check = 1;
        // 默认为公开的文章
        $dynamic->is_public = 1;
        // 创建Ip与浏览器类型
        $ip_agent = get_client_info();
        $dynamic->created_ip = $ip_agent['ip'] ?? $request->getClientIp();
        $dynamic->browser_type = $ip_agent['agent'] ?? $_SERVER['HTTP_USER_AGENT'];
        $dynamic->save();

        return redirect()->to($dynamic->link())->with('success', '帖子`' . $dynamic->dynamic_title . '`创建成功！');
    }

    public function edit(Dynamic $dynamic)
    {
        $this->authorize('update', $dynamic);
        return view('forum::dynamic.create_and_edit', compact('dynamic'));
    }

    public function update(DynamicRequest $request, Dynamic $dynamic)
    {
        $this->authorize('update', $dynamic);

        $params = $request->only('dynamic_title', 'dynamic_markdown', 'topic_id');
        // 如果存在html，则赋值
        if ($request->has('editormd_id-html-code')){
            $params['dynamic_content'] = $request->input('editormd_id-html-code');
        }
        $dynamic->update($params);

        return redirect()->to($dynamic->link())->with('success', '更新成功！');
    }

    public function destroy(Dynamic $dynamic)
    {
        $this->authorize('destroy', $dynamic);
        $dynamic->delete();

        return redirect()->route('home')->with('success', '成功删除！');
    }
}
