<?php
namespace App\Modules\Comment\Services;

use App\Exceptions\Exception;
use App\Exceptions\HttpStatus\BadRequestException;
use App\Modules\Comment\Entities\DynamicCommentPraise;
use App\Modules\Forum\Entities\Notify;
use App\Modules\User\Entities\UserInfo;
use App\Traits\Error;
use App\Traits\Instance;
use Illuminate\Support\Facades\DB;

class DynamicService
{
    use Error;
    use Instance;

    public function praise($login_user_id, $comment, &$is_praise = true)
    {
        $dynamicCommentPraise = DynamicCommentPraise::getInstance();
        $data              = [
            'user_id'    => $login_user_id,
            'comment_id' => $comment->comment_id,
            'dynamic_id' => $comment->dynamic_id,
        ];
        $is_praise = true;
        $praise = [];
        DB::beginTransaction();
        try {
            // 动态的作者
            $author = $comment->user_id;

            $userInfoInstance = UserInfo::getInstance();
            $parise_num = 1;
            // 是否已点赞过了该动态
            if ($dynamicCommentPraise->isPraise($login_user_id, $comment->comment_id)) {
                $parise_num = -1;
                // 删除点赞记录[先first再delete，为了触发模型实际]
                $dynamicCommentPraise->where($data)->first()->delete();
                // 会员获赞数递减
                $userInfoInstance->setGetLikes($author, -1);

                $is_praise = false;
                $this->setError('取消回复点赞成功！');
            } else {
                $ip_agent = get_client_info();
                $praise = $dynamicCommentPraise->create(array_merge($data, [
                    'created_time' => time(),
                    'created_ip'   => $ip_agent['ip'] ?? get_ip(),
                    'browser_type' => $ip_agent['agent'] ?? $_SERVER['HTTP_USER_AGENT'],
                ]));
                // 获赞数递增
                $userInfoInstance->setGetLikes($author, 1);

                // 互动消息：xxx 点赞了您的评论 xxx。
                if ($author != $login_user_id) {
                    $notify = Notify::insert([
                        'notify_type'  => Notify::NOTIFY_TYPE['INTERACT_MSG'],
                        'user_id'      => $author,
                        'target_id'    => $comment->comment_id,
                        'target_type'  => Notify::TARGET_TYPE['DYNAMIC'],
                        'sender_id'    => $login_user_id,
                        'sender_type'  => Notify::SYSTEM_SENDER,
                        'dynamic_type' => Notify::DYNAMIC_TARGET_TYPE['COMMENT_PRAISE'],
                        'extend_id' => $comment->comment_id,
                    ]);
                    if (!$notify) {
                        throw new BadRequestException('互动消息录入失败！');
                    }
                }
                $this->setError('回复点赞成功！');
            }
            // 评论的点赞量实时变动（沉余字段）
            $comment->increment('praise_count', $parise_num);

            DB::commit();
            return $praise;
        } catch (Exception $e) {
            DB::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }
}
