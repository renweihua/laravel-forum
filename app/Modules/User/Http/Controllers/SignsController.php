<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Modules\User\Services\SignService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignsController extends ApiController
{
    public function __construct(SignService $service)
    {
        $this->service = $service;
    }

    /**
     * 今日签到信息
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSignByToday() : JsonResponse
    {
        $result = $this->service->getSignByToday(getLoginUserId());
        return $this->successJson($result);
    }

    /**
     * 每日签到
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn() : JsonResponse
    {
        $is_sign = $this->service->signIn(getLoginUserId());
        return $this->successJson([], $this->service->getError(), compact('is_sign'));
    }

    /**
     * 指定月份的签到状态
     *
     * @param  \App\Modules\Bbs\Http\Requests\User\MonthRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSignsStatusByMonth(MonthRequest $request) : JsonResponse
    {
        $data = $request->validated();

        $lists = $this->service->getSignsStatusByMonth(getLoginUserId(), $data['search_month']);
        return $this->successJson($lists, '签到状态获取成功！');
    }

    /**
     * 我的签到记录
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSignsByMonth(Request $request) : JsonResponse
    {
        $lists = $this->service->getSignsByMonth(Auth::id(), $request->input('search_month', ''));
        return $this->successJson($lists, '签到记录获取成功！');
    }
}
