<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Http\Requests\DynamicIdRequest;
use App\Modules\Forum\Services\DynamicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DynamicsApiController extends ForumController
{
    protected DynamicService $dynamicService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api', ['except' => []]);

        $this->dynamicService = DynamicService::getInstance();
    }

    public function praise(DynamicIdRequest $request): JsonResponse
    {
        $dynamic_id = $request->input('dynamic_id');
        $dynamic = Dynamic::getDynamicById($dynamic_id);
        if (empty($dynamic)){
            return $this->errorJson('动态不存在或已删除！');
        }

        $login_user_id = Auth::id();

        $praise = $this->dynamicService->praise($login_user_id, $dynamic, $is_praise);

        return $this->successJson($praise, $this->dynamicService->getError(), compact('is_praise'));
    }

    public function collection(DynamicIdRequest $request): JsonResponse
    {
        $dynamic_id = $request->input('dynamic_id');
        $dynamic = Dynamic::getDynamicById($dynamic_id);
        if (empty($dynamic)){
            return $this->errorJson('动态不存在或已删除');
        }

        $login_user_id = Auth::id();

        $collection = $this->dynamicService->collection($login_user_id, $dynamic, $is_collection);

        return $this->successJson($collection, $this->dynamicService->getError(), compact('is_collection'));
    }
}
