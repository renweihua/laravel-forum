<?php
namespace App\Modules\Forum\Services;

use App\Modules\Comment\Entities\DynamicComment;
use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Entities\Notify;
use App\Modules\Topic\Entities\Topic;
use App\Modules\User\Entities\UserInfo;
use App\Services\Service;

class NotifyService extends Service
{
    public static function format(&$notifies, &$set_read_nums = 0)
    {
        $notifyInstance = Notify::getInstance();
        /**
         * 消息数据格式处理
         */
        $topic_ids = $user_ids = $dynamic_ids = $comment_ids = [];
        $user_infos = $dynamics = [];
        // 设置已读数量
        $set_read_nums = 0;

        foreach ($notifies as $item){
            switch ($item->target_type){
                case $notifyInstance::TARGET_TYPE['DYNAMIC']: // 动态
                    $dynamic_ids[] = $item->target_id;
                    // 评论动态
                    if(
                        $item->dynamic_type == $notifyInstance::DYNAMIC_TARGET_TYPE['COMMENT']
                        ||
                        $item->dynamic_type == $notifyInstance::DYNAMIC_TARGET_TYPE['REPLY_COMMENT']
                        ||
                        $item->dynamic_type == $notifyInstance::DYNAMIC_TARGET_TYPE['COMMENT_PRAISE']
                    ) $comment_ids[] = $item->extend_id;
                    break;
                case $notifyInstance::TARGET_TYPE['FOLLOW']: // 关注
                    $user_ids[] = $item->sender_id;
                    break;
                case $notifyInstance::TARGET_TYPE['SUBSCRIBE']: // 订阅
                    switch ($item->subscribe_type){
                        case Notify::SUBSCRIBE_TYPE['TOPIC']: // 话题
                            $topic_ids[] = $item->target_id;
                            break;
                        case Notify::SUBSCRIBE_TYPE['DYNAMIC']: // 动态
                            $dynamic_ids[] = $item->target_id;
                            break;
                    }
                    break;
            }

            // 标记未读的记录：设置为已读状态
            if ($item->is_read == 0){
                $item->is_read = 1;
                $item->save();

                ++$set_read_nums;
            }
        }
        if (!empty($dynamic_ids)){
            $dynamics = Dynamic::getListByIds($dynamic_ids);
        }
        if (!empty($user_ids)){
            $user_infos = UserInfo::getListByIds($user_ids);
        }
        if (!empty($comment_ids)){
            $comment_infos = DynamicComment::getListByIds($comment_ids);
        }
        if (!empty($topic_ids)){
            $topic_infos = Topic::getListByIds($topic_ids);
        }

        foreach ($notifies as $item){
            switch ($item->target_type){
                case $notifyInstance::TARGET_TYPE['DYNAMIC']: // 动态
                    $item->relation = isset($dynamics[$item->target_id]) ? $dynamics[$item->target_id] : false;
                    // 评论
                    if(
                        $item->dynamic_type == $notifyInstance::DYNAMIC_TARGET_TYPE['COMMENT']
                        ||
                        $item->dynamic_type == $notifyInstance::DYNAMIC_TARGET_TYPE['REPLY_COMMENT']
                        ||
                        $item->dynamic_type == $notifyInstance::DYNAMIC_TARGET_TYPE['COMMENT_PRAISE']
                    ){
                        $item->comment = (object)($comment_infos[$item->extend_id] ?? []);
                    }
                    $notifyInstance->setExplain($item);
                    break;
                case $notifyInstance::TARGET_TYPE['FOLLOW']: // 关注
                    $item->relation = isset($user_infos[$item->sender_id]) ? (object)$user_infos[$item->sender_id] : false;
                    $item->explain = '关注了您';
                    break;
                case $notifyInstance::TARGET_TYPE['SUBSCRIBE']: // 订阅
                    switch ($item->subscribe_type){
                        case Notify::SUBSCRIBE_TYPE['TOPIC']: // 话题
                            $item->relation = isset($topic_infos[$item->target_id]) ? (object)$topic_infos[$item->target_id] : false;
                            $item->explain = '订阅话题{' . ($item->relation->topic_name ?? '') . '}';
                            break;
                        case Notify::SUBSCRIBE_TYPE['DYNAMIC']: // 动态
                            $item->relation = isset($dynamics[$item->target_id]) ? $dynamics[$item->target_id] : false;
                            $item->explain = '订阅动态{' . ($item->relation->dynamic_title ?? '') . '}';
                            break;
                    }
                    break;
                default:
                    $item->relation = (object)[];
                    $item->explain = $item->notify_content;
                    break;
            }
        }

        return $notifies;
    }
}
