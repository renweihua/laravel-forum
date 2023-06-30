<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Http\Requests\DynamicRequest;
use App\Modules\Topic\Entities\Topic;
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
        $dynamic = Dynamic::with(['user', 'userInfo'])->find($dynamic_id);
        if (empty($dynamic)){
            abort(404, '动态不存在或已删除！');
        }
        // URL 矫正
        if (!empty($dynamic->slug) && $dynamic->slug != $request->slug) {
            return redirect($dynamic->link(), 301);
        }
        // // 会员的动态数量
        // $dynamic->user->dynamic_count = Dynamic::getDynamicsTotalByUser($dynamic->user_id);
        return view('forum::dynamic.show', compact('dynamic'));
    }

    public function create(Dynamic $dynamic)
    {
        $topics = Topic::getAllTopics();
        return view('forum::dynamic.create_and_edit', compact('dynamic', 'topics'));
    }

    public function store(DynamicRequest $request, Dynamic $dynamic)
    {
        // 限制可设置的字段
        $dynamic->fill($request->only('dynamic_title', 'dynamic_content', 'topic_id'));
        $dynamic->user_id = Auth::id();
        // 限制htmll类型
        $dynamic->content_type = Dynamic::CONTENT_TYPE_HTML;
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
        $topics = Topic::getAllTopics();
        return view('forum::dynamic.create_and_edit', compact('dynamic', 'topics'));
    }

    public function update(DynamicRequest $request, Dynamic $dynamic)
    {
        $this->authorize('update', $dynamic);
        $dynamic->fill($request->only('dynamic_title', 'dynamic_content', 'topic_id'));

        return redirect()->to($dynamic->link())->with('success', '更新成功！');
    }

    public function destroy(Dynamic $dynamic)
    {
        $this->authorize('destroy', $dynamic);
        $dynamic->delete();

        return redirect()->route('home')->with('success', '成功删除！');
    }
}
