<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Http\Requests\FollowUserRequest;
use App\Modules\User\Services\FriendService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FriendsController extends UserModuleController
{
    // 关注会员
    public function follow(FollowUserRequest $request, FriendService $friendService): JsonResponse
    {
        $user_id = $request->input('user_id');
        $login_user_id = Auth::id();
        if ($user_id == $login_user_id){
            return $this->errorJson('无需关注自己！');
        }

        $res = $friendService->setFollow($login_user_id, $user_id);

        return $this->successJson([], $friendService->getError(), $res);
    }
}
