<?php

namespace App\Models\Forum\Entities;

use App\Models\Model;
use App\Models\Forum\Entities\User;

class SubscribeDynamic extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    const CHANGE_TYPE = [
        'PRAISE' => 0, // 点赞
        'COLLECTION' => 1, // 收藏
        'COMMENT' => 2, // 评论
        'REPLY_COMMENT' => 3, // 回复
    ];

    public static function getTextByChangeType($type): string
    {
        $text = '点赞';
        switch ($type){
            case self::CHANGE_TYPE['COLLECTION']:
                $text = '收藏';
                break;
            case self::CHANGE_TYPE['COMMENT']:
                $text = '评论';
                break;
            case self::CHANGE_TYPE['REPLY_COMMENT']:
                $text = '回复';
                break;
        }
        return $text;
    }

    /**
     * 指定会员是否已【订阅】了指定动态
     *
     * @param int $dynamic_id
     * @param int $login_user
     *
     * @return SubscribeDynamic|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getSubscribe(int $dynamic_id, int $login_user)
    {
        return self::where([
            'dynamic_id' => $dynamic_id,
            'user_id' => $login_user,
        ])->first();
    }
}
