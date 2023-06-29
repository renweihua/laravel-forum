<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Http\Requests\DynamicRequest;
use App\Modules\Topic\Entities\Topic;
use Illuminate\Support\Facades\Auth;

class DynamicController extends ForumController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function show($dynamic_id)
    {
        $dynamic = Dynamic::with(['user', 'userInfo'])->find($dynamic_id);
        if (empty($dynamic)){
            abort(404, '动态不存在或已删除！');
        }
        // // 会员的动态数量
        // $dynamic->user->dynamic_count = Dynamic::getDynamicsTotalByUser($dynamic->user_id);
        return $this->view('forum::dynamic.show', compact('dynamic'));
    }

    public function create(Dynamic $dynamic)
    {
        $topics = Topic::getAllTopics();
        return $this->view('forum::dynamic.create_and_edit', compact('dynamic', 'topics'));
    }

    public function store(DynamicRequest $request, Dynamic $dynamic)
    {
        $dynamic->fill($request->all());
        $dynamic->user_id = Auth::id();
        // 默认为已审核的
        $dynamic->is_check = 1;
        $dynamic->save();

        return redirect()->route('dynamic.show', $dynamic->dynamic_id)->with('success', '帖子`' . $dynamic->dynamic_title . '`创建成功！');
    }

    public function edit(Dynamic $dynamic)
    {
        $this->authorize('update', $dynamic);
        $topics = Topic::getAllTopics();
        return $this->view('forum::dynamic.create_and_edit', compact('dynamic', 'topics'));
    }

    public function update(DynamicRequest $request, Dynamic $dynamic)
    {
        $this->authorize('update', $dynamic);
        $dynamic->update($request->all());

        return redirect()->route('dynamic.show', $dynamic->dynamic_id)->with('success', '更新成功！');
    }

    public function destroy(Dynamic $dynamic)
    {
        $this->authorize('destroy', $dynamic);
        $dynamic->delete();

        return redirect()->route('home')->with('success', '成功删除！');
    }
}
