<?php
namespace App\Modules\Topic\Services;

use App\Exceptions\Exception;
use App\Exceptions\HttpStatus\BadRequestException;
use App\Modules\Forum\Entities\Notify;
use App\Modules\Topic\Entities\Topic;
use App\Modules\Topic\Entities\TopicFollow;
use App\Modules\User\Entities\UserFollowFan;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class TopicService extends Service
{
    /**
     * 关注指定话题
     *
     * @param  int  $login_user_id
     * @param  int  $topic_id
     *
     * @return bool|bool[]
     */
    public function setFollow(int $login_user_id, int $topic_id)
    {
        $topicFollowFan = TopicFollow::getInstance();
        // 获取当前荟吧详情
        $topic = Topic::lock(true)->find($topic_id);
        if ( !$topic) {
            throw new Exception('荟吧详情获取失败！');
        }
        // 登录会员是否关注荟吧
        $follow = $topicFollowFan->checkFollow($login_user_id, $topic_id);

        $msg = $follow ? '取关' : '关注';
        DB::beginTransaction();
        try {
            $data = [
                'user_id'  => $login_user_id,
                'topic_id' => $topic_id,
            ];
            if ($follow) {
                // 删除我关注荟吧记录
                $follow->delete();

                // 荟吧记录，关注人数：递减
                $topic->decrement('follow_count');
            } else {
                // 关注荟吧记录
                $topicFollowFan->create(array_merge($data, [
                    'created_time' => time(),
                ]));

                // 荟吧记录，关注人数：递增
                $topic->increment('follow_count');

                // 互动消息：我关注了荟吧<xxx>
                if (!Notify::insert([
                    'notify_type' => Notify::NOTIFY_TYPE['SYSTEM_MSG'],
                    'user_id'     => $login_user_id,
                    'target_id'   => $topic_id,
                    'target_type' => Notify::TARGET_TYPE['SUBSCRIBE'],
                    'subscribe_type' => Notify::SUBSCRIBE_TYPE['TOPIC'],
                    'sender_id'   => 0,
                    'sender_type' => Notify::SYSTEM_SENDER,
                ])) {
                    throw new BadRequestException('互动消息录入失败！');
                }
            }

            DB::commit();
            $this->setError($msg . '成功！');
            return ['is_follow' => $follow ? false : true];
        } catch (Exception $e) {
            DB::rollBack();
            throw new BadRequestException($msg . '失败！');
        }
    }
}
