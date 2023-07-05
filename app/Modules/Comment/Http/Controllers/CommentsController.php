<?php

namespace App\Modules\Comment\Http\Controllers;

use App\Modules\Comment\Http\Requests\CommentRequest;
use App\Modules\Comment\Entities\DynamicComment;
use App\Modules\Comment\Jobs\DynamicCommentNotifyJob;
use App\Modules\Forum\Entities\Dynamic;
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
        $dynamic_id = $request->dynamic_id;
        $dynamic = Dynamic::getDynamicById($dynamic_id);
        if (!$dynamic){
            abort(404, '动态不存在或已删除！');
        }
        $dynamicCommentInstance = DynamicComment::getInstance();

        $reply_id = $request->input('reply_id', 0);
        // 如果评论，那么默认就是发布者
        $reply_user = 0;
        $top_level  = 0;
        // 验证回复的评论
        if ( !empty($reply_id)) {
            if ( !$detail = $dynamicCommentInstance->where('comment_id', $reply_id)->first()) {
                abort(400, '回复的评论信息不存在或已删除！');
            }
            // 顶级Id
            $top_level  = $detail->top_level == 0 ? $detail->comment_id : $detail->top_level;
            $reply_user = $detail->user_id;
        }

        $comment->user_id = Auth::id();
        $comment->dynamic_id = $dynamic->dynamic_id;
        $comment->content_type = Dynamic::CONTENT_TYPE_MARKDOWN;
        $comment->comment_markdown = $request->comment_markdown;
        $comment->author_id = $dynamic->user_id;
        $comment->top_level = $top_level;
        $comment->reply_user = $reply_user;
        // 如果评论者与被回复人是同一个人，那么则默认已读，无需通知
        $comment->is_read = $comment->user_id == $reply_user ? 1 : 0;
        // 创建Ip与浏览器类型
        $ip_agent = get_client_info();
        $comment->created_ip = $ip_agent['ip'] ?? $request->getClientIp();
        $comment->browser_type = $ip_agent['agent'] ?? $_SERVER['HTTP_USER_AGENT'];
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
