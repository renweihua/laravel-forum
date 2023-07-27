<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Constants\HttpStatus;

trait Json
{
    protected $http_status = HttpStatus::SUCCESS;

    public function successJson($data = [], $msg = 'success', $other = [], array $header = [])
    {
        return $this->formatStructure(array_merge(['data' => $data, 'msg' => $msg], $other), $header);
    }

    public function errorJson($msg = 'error', $http_status = HttpStatus::BAD_REQUEST, $data = [], $other = [], array $header = [])
    {
        return $this->formatStructure(array_merge(['msg' => $msg, 'http_status' => $http_status, 'data' => $data], $other), $header);
    }

    public function formatStructure($data, array $header = [])
    {
        $data['data'] = $data['data'] ?? [];
        if(!isset($data['http_status'])) $data['http_status'] = $this->http_status;
        switch ($data['http_status']){
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

        // 如果设置的header的Token返回，那么追加参数
        if ($authorization = request()->header('new_authorization')) $header['Authorization'] = $authorization;

        // JSON_UNESCAPED_UNICODE 256：Json不要编码Unicode
        return response()->json($data, $data['http_status'], $header, 256);
    }
}
