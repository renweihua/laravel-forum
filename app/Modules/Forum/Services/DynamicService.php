<?php
namespace App\Modules\Forum\Services;

use App\Exceptions\Exception;
use App\Exceptions\HttpStatus\BadRequestException;
use App\Modules\Forum\Entities\DynamicCollection;
use App\Modules\Forum\Entities\DynamicPraise;
use App\Modules\Forum\Entities\Notify;
use App\Modules\Forum\Entities\SubscribeDynamic;
use App\Modules\User\Entities\UserInfo;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class DynamicService extends Service
{
    public function praise($login_user_id, $dynamic, &$is_praise = true)
    {
        $dynamic_id = $dynamic->dynamic_id;
        $dynamicPraise = DynamicPraise::getInstance();
        $data              = [
            'user_id'    => $login_user_id,
            'dynamic_id' => $dynamic_id,
        ];
        $is_praise = true;
        $praise = [];
        DB::beginTransaction();
        try {
            // 动态的作者
            $author = $dynamic->user_id;
            $userInfoInstance = UserInfo::getInstance();
            // 是否已点赞过了该动态
            if ($dynamicPraise->isPraise($login_user_id, $dynamic_id)) {
                // 删除点赞记录[先first再delete，为了触发模型实际]
                $dynamicPraise->where($data)->first()->delete();
                // 会员获赞数递减
                $userInfoInstance->setGetLikes($author, -1);

                $is_praise = false;
                $this->setError('取消点赞成功！');
            } else {
                $ip_agent = get_client_info();
                $praise = $dynamicPraise->create(array_merge($data, [
                    'created_time' => time(),
                    'created_ip'   => $ip_agent['ip'] ?? get_ip(),
                    'browser_type' => $ip_agent['agent'] ?? $_SERVER['HTTP_USER_AGENT'],
                ]));
                // 获赞数递增
                $userInfoInstance->setGetLikes($author, 1);

                // 互动消息：xxx 收藏了您的动态 xxx。
                if ($dynamic->user_id != $login_user_id) {
                    $notify = Notify::insert([
                        'notify_type'  => Notify::NOTIFY_TYPE['INTERACT_MSG'],
                        'user_id'      => $dynamic->user_id,
                        'target_id'    => $dynamic_id,
                        'target_type'  => Notify::TARGET_TYPE['DYNAMIC'],
                        'sender_id'    => $login_user_id,
                        'sender_type'  => Notify::SYSTEM_SENDER,
                        'dynamic_type' => Notify::DYNAMIC_TARGET_TYPE['PRAISE'],
                    ]);
                    if (!$notify) {
                        throw new BadRequestException('互动消息录入失败！');
                    }
                }

                $this->setError('点赞成功！');
            }

            DB::commit();
            return $praise;
        } catch (Exception $e) {
            DB::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    public function collection($login_user_id, $dynamic, &$is_collection = true)
    {
        $dynamic_id = $dynamic->dynamic_id;
        $dynamicCollection = DynamicCollection::getInstance();
        $data              = [
            'user_id'    => $login_user_id,
            'dynamic_id' => $dynamic_id,
        ];
        $is_collection = true;
        $collection = [];
        DB::beginTransaction();
        try {
            // 是否已点赞过了该动态
            if ($dynamicCollection->isCollection($login_user_id, $dynamic_id)) {
                // 删除点赞记录[先first再delete，为了触发模型实际]
                $dynamicCollection->where($data)->first()->delete();

                $is_collection = false;
                $this->setError('取消收藏成功！');
            } else {
                $ip_agent = get_client_info();
                $collection = $dynamicCollection->create(array_merge($data, [
                    'created_time' => time(),
                    'created_ip'   => $ip_agent['ip'] ?? get_ip(),
                    'browser_type' => $ip_agent['agent'] ?? $_SERVER['HTTP_USER_AGENT'],
                ]));

                // 互动消息：xxx 收藏了您的动态 xxx。
                if ($dynamic->user_id != $login_user_id) {
                    $notify = Notify::insert([
                        'notify_type'  => Notify::NOTIFY_TYPE['INTERACT_MSG'],
                        'user_id'      => $dynamic->user_id,
                        'target_id'    => $dynamic_id,
                        'target_type'  => Notify::TARGET_TYPE['DYNAMIC'],
                        'sender_id'    => $login_user_id,
                        'sender_type'  => Notify::SYSTEM_SENDER,
                        'dynamic_type' => Notify::DYNAMIC_TARGET_TYPE['COLLECTION'],
                    ]);
                    if (!$notify) {
                        throw new BadRequestException('互动消息录入失败！');
                    }
                }

                $this->setError('动态收藏成功！');
            }

            DB::commit();
            return $collection;
        } catch (Exception $e) {
            DB::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    // 订阅动态流程
    public function subscribe(int $login_user_id, $dynamic, &$is_subscribe = true)
    {
        $is_subscribe = true;
        $subscribe = [];
        DB::beginTransaction();
        try {
            // 是否已订阅过了该动态
            if ($result = SubscribeDynamic::getSubscribe($dynamic->dynamic_id, $login_user_id)) {
                $result->delete();
                $this->setError('取消订阅成功！');
                $is_subscribe = false;
            } else {
                $ip_agent = get_client_info();
                $subscribe = SubscribeDynamic::create([
                    'dynamic_id' => $dynamic->dynamic_id,
                    'user_id'    => $login_user_id,
                    'created_ip'   => $ip_agent['ip'] ?? get_ip(),
                    'browser_type' => $ip_agent['agent'] ?? $_SERVER['HTTP_USER_AGENT'],
                ]);

                // 互动消息：xxx 订阅了您的动态 xxx。
                if ($dynamic->user_id != $login_user_id) {
                    $result = Notify::insert([
                        'notify_type'  => Notify::NOTIFY_TYPE['INTERACT_MSG'],
                        'user_id'      => $dynamic->user_id,
                        'target_id'    => $dynamic->dynamic_id,
                        'target_type'  => Notify::TARGET_TYPE['SUBSCRIBE'],
                        'sender_id'    => $login_user_id,
                        'sender_type'  => Notify::SYSTEM_SENDER,
                        'dynamic_type' => Notify::DYNAMIC_TARGET_TYPE['SUBSCRIBE'],
                        'subscribe_type' => Notify::SUBSCRIBE_TYPE['DYNAMIC'],
                    ]);
                    if (!$result) {
                        throw new BadRequestException('互动消息录入失败！');
                    }
                }

                $this->setError('订阅`' . $dynamic->dynamic_title . '`成功！');
            }

            DB::commit();
            return $subscribe;
        } catch (Exception $e) {
            DB::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }
}
