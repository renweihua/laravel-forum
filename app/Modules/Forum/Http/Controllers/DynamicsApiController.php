<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Http\Requests\DynamicIdRequest;
use App\Modules\Forum\Services\DynamicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DynamicsApiController extends ForumController
{
    public function praise(DynamicIdRequest $request, DynamicService $dynamicService): JsonResponse
    {
        $dynamic_id = $request->input('dynamic_id');
        $dynamic = Dynamic::getDynamicById($dynamic_id);
        if (empty($dynamic)){
            return $this->errorJson('动态不存在或已删除！');
        }

        $login_user_id = Auth::id();

        $praise = $dynamicService->praise($login_user_id, $dynamic, $is_praise);

        return $this->successJson($praise, $dynamicService->getError(), compact('is_praise'));
    }

    public function collection(DynamicIdRequest $request, DynamicService $dynamicService): JsonResponse
    {
        $dynamic_id = $request->input('dynamic_id');
        $dynamic = Dynamic::getDynamicById($dynamic_id);
        if (empty($dynamic)){
            return $this->errorJson('动态不存在或已删除！');
        }

        $login_user_id = Auth::id();

        $collection = $dynamicService->collection($login_user_id, $dynamic, $is_collection);

        return $this->successJson($collection, $dynamicService->getError(), compact('is_collection'));
    }

    public function subscribe(DynamicIdRequest $request, DynamicService $dynamicService): JsonResponse
    {
        $dynamic_id = $request->input('dynamic_id');
        $dynamic = Dynamic::getDynamicById($dynamic_id);
        if (empty($dynamic)){
            return $this->errorJson('动态不存在或已删除！');
        }

        $login_user_id = Auth::id();

        $subscribe = $dynamicService->subscribe($login_user_id, $dynamic, $is_subscribe);

        return $this->successJson($subscribe, $dynamicService->getError(), compact('is_subscribe'));
    }
}
