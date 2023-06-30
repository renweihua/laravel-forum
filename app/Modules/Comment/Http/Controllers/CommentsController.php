<?php

namespace App\Modules\Comment\Http\Controllers;

use App\Modules\Comment\Http\Requests\CommentRequest;
use App\Modules\Comment\Entities\DynamicComment;
use App\Modules\Comment\Jobs\DynamicCommentNotifyJob;
use Illuminate\Support\Facades\Auth;

class CommentsController extends CommentModuleController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function store(CommentRequest $request, DynamicComment $comment)
    {
        $comment->user_id = Auth::id();
        $comment->comment_content = $request->comment_content;
        $comment->dynamic_id = $request->dynamic_id;
        $comment->save();

        // 通知动态作者有新的评论/回复
        DynamicCommentNotifyJob::dispatch($comment);

        return redirect()->to($comment->dynamic->link())->with('success', '评论创建成功！');
    }

    public function destroy(DynamicComment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();

        return redirect()->to($comment->dynamic->link())->with('success', '评论删除成功！');
    }
}
