<?php
namespace App\Modules\User\Services;

use App\Exceptions\Exception;
use App\Exceptions\HttpStatus\BadRequestException;
use App\Modules\Forum\Entities\Notify;
use App\Modules\User\Entities\UserFollowFan;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class FriendService extends Service
{
    /**
     * 关注指定会员流程
     *
     * @param  int  $login_user_id
     * @param  int  $friend_id
     *
     * @return bool|bool[]
     */
    public function setFollow(int $login_user_id, int $friend_id)
    {
        $userFollowFan = UserFollowFan::getInstance();
        // 对方是否关注了登录会员
        $friend_follow = $userFollowFan->checkFollow($friend_id, $login_user_id);
        // 我是否关注对方
        $my_follow = $userFollowFan->checkFollow($login_user_id, $friend_id);

        $msg = $my_follow ? '取关' : '关注';
        DB::beginTransaction();
        try {
            $data = [
                'user_id' => $login_user_id,
                'friend_id' => $friend_id,
            ];
            if ($my_follow) {
                // 删除我关注对方
                $my_follow->delete();
                // 删除对方与我是互关的状态
                if ($friend_follow) $friend_follow->save(['cross_correlation' => 0]);
            } else {
                // 被关注，那么双方标记为互关，好友；更改对方的互关状态
                if ($friend_follow) {
                    $friend_follow->save(['cross_correlation' => 1]);

                    $data['cross_correlation'] = 1;
                }
                $userFollowFan->create(array_merge($data, [
                    'created_time' => time(),
                ]));

                // 系统消息：谁关注了您
                if ($friend_id != $login_user_id){
                    if (!Notify::insert([
                        'notify_type'  => Notify::NOTIFY_TYPE['SYSTEM_MSG'],
                        'user_id'      => $friend_id,
                        'target_type'  => Notify::TARGET_TYPE['FOLLOW'],
                        'sender_id'    => $login_user_id,
                        'sender_type'  => Notify::SYSTEM_SENDER,
                    ]) ) {
                        throw new BadRequestException('互动消息录入失败！');
                    }
                }
            }

            DB::commit();
            $this->setError($msg . '成功！');
            return ['is_follow' => $my_follow ? false : true];
        } catch (Exception $e) {
            DB::rollBack();
            throw new BadRequestException($msg . '失败！');
        }
    }
}
