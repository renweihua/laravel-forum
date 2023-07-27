<?php

namespace App\Modules\User\Entities;

use App\Models\Model;

class UserLoginLog extends Model
{
    protected $primaryKey = 'log_id';
    protected $is_delete = 0;
    protected $appends = ['time_formatting'];

    public function add(int $user_id = 0, int $log_status = 1, $description = '登录成功')
    {
        $ip_agent = get_client_info();
        return $this->setMonthTable()->create([
            'user_id' => $user_id,
            'created_ip'   => $ip_agent['ip'] ?? get_ip(),
            'browser_type' => $ip_agent['agent'] ?? $_SERVER['HTTP_USER_AGENT'],
            'log_status' => $log_status,
            'description' => $description,
            'log_duration' => microtime(true) - LARAVEL_START,
            'request_data' => my_json_encode(request()->all()),
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
