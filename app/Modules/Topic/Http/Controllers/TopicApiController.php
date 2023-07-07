<?php

namespace App\Modules\Topic\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Entities\Friendlink;
use App\Modules\Topic\Entities\Topic;
use App\Modules\Topic\Http\Requests\TopicIdRequest;
use App\Modules\Topic\Services\TopicService;
use App\Modules\User\Entities\User;
use App\Modules\User\Entities\UserAuth;
use App\Modules\User\Entities\UserInfo;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicApiController extends TopicModuleController
{
    /**
     * 关注指定话题
     */
    public function follow(TopicIdRequest $request, TopicService $topicService) : JsonResponse
    {
        $res = $topicService->setFollow(Auth::id(), (int)$request->input('topic_id'));

        return $this->successJson([], $topicService->getError(), $res);
    }
}
