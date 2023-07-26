<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Modules\User\Services\SignService;
use Illuminate\Http\JsonResponse;

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
        $result = $this->service->getSignByToday($this->getLoginUserId());
        return $this->successJson($result);
    }

    /**
     * 每日签到
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn() : JsonResponse
    {
        $this->service->signIn($this->getLoginUserId());
        return $this->successJson([], $this->service->getError());
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

        $lists = $this->service->getSignsStatusByMonth($this->getLoginUserId(), $data['search_month']);
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
        $lists = $this->service->getSignsByMonth($this->getLoginUserId(), $request->input('search_month', ''));
        return $this->successJson($lists, '签到记录获取成功！');
    }
}
