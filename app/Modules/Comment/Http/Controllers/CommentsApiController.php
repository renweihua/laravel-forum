<?php

namespace App\Modules\Comment\Http\Controllers;

use App\Modules\Comment\Http\Requests\CommentIdRequest;
use App\Modules\Comment\Entities\DynamicComment;
use App\Modules\Comment\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CommentsApiController extends CommentModuleController
{
    public function praise(CommentIdRequest $request, CommentService $commentService): JsonResponse
    {
        $comment_id = $request->input('comment_id');
        $comment = DynamicComment::find($comment_id);
        if (empty($comment)){
            return $this->errorJson('动态评论不存在或已删除！');
        }

        $login_user_id = Auth::id();

        $praise = $commentService->praise($login_user_id, $comment, $is_praise);

        return $this->successJson($praise, $commentService->getError(), compact('is_praise'));
    }
}
