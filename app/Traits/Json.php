<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Constants\HttpStatus;

trait Json
{
    protected $http_code = HttpStatus::SUCCESS;

    public function setHttpCode($http_code){
        $this->http_code = $http_code;
    }

    public function successJson($data = [], $msg = 'success', $other = [], array $header = [])
    {
        return $this->myAjaxReturn(array_merge(['data' => $data, 'msg' => $msg], $other), $header);
    }

    public function errorJson($msg = 'error', $http_code = HttpStatus::BAD_REQUEST, $data = [], $other = [], array $header = [])
    {
        return $this->myAjaxReturn(array_merge(['msg' => $msg, 'http_code' => $http_code, 'data' => $data], $other), $header);
    }

    public function myAjaxReturn($data, array $header = [])
    {
        $data['data'] = $data['data'] ?? [];
        if(!isset($data['http_code'])) $data['http_code'] = $this->http_code;
        switch ($data['http_code']){
            case HttpStatus::SUCCESS:
                $data['status'] = 1;
                break;
            case HttpStatus::BAD_REQUEST:
                $data['status'] = 0;
                break;
            case HttpStatus::UNAUTHORIZED:
                $data['status'] = -1;
                break;
            case HttpStatus::FORBIDDEN:
                $data['status'] = -2;
                break;
        }
        $data['msg'] = $data['msg'] ?? (empty($data['status']) ? '数据不存在！' : 'success');
        $data['execution_time'] = microtime(true) - LARAVEL_START;
        $data['http_status'] = $data['http_code'];

        // 如果设置的header的Token返回，那么追加参数
        if ($authorization = request()->header('new_authorization')) $header['Authorization'] = $authorization;

        // JSON_UNESCAPED_UNICODE 256：Json不要编码Unicode
        return response()->json($data, $data['http_status'], $header, 256);
    }
}
