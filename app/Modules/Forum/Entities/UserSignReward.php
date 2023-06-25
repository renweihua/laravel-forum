<?php

namespace App\Models\Forum\Entities;

use App\Models\Model;
use Illuminate\Support\Facades\Cache;

class UserSignReward extends Model
{
    protected $is_delete = 0; //是否开启删除（1.开启删除，就是直接删除；0.假删除）

    protected $casts = [
        'reward_text' => 'array'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::updated(function(){
            self::getRewardConfigs(true);
        });

        self::saved(function(){
            self::getRewardConfigs(true);
        });

        self::deleted(function(){
            self::getRewardConfigs(true);
        });
    }

    /**
     * 获取签到的奖励配置
     *
     * @param  bool  $force
     *
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function getRewardConfigs(bool $force = false)
    {
        $key = 'sign_reward_configs';
        $exist = Cache::has($key);
        if (!$exist || $force){
            $configs = self::orderBy('sign_day')->get();
            Cache::set($key, $configs);
        }
        $configs = Cache::get($key);
        return $configs;
    }
}
