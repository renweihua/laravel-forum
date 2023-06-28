<?php

namespace App\Modules\Forum\Constants;

class DynamicCacheKeys
{
    // 默认的前缀
    const PREFIX = ':bbs:dynamic:';

    // 浏览量的（有序集合）缓存Key
    public static function getDynamicReadNumCacheKey(): string
    {
        return self::PREFIX . 'read_num:dynamic_id';
    }

    public static function getDynamicCacheKey(int $dynamic_id, int $login_user_id = 0): string
    {
        return self::PREFIX . 'dynamic_id:' . $dynamic_id . ':login_user_id:' . $login_user_id;
    }
}
