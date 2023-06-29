<?php

namespace App\Modules\Comment\Jobs;

use App\Modules\Comment\Emails\DynamicCommentNotify;
use App\Modules\Forum\Entities\Notify;
use App\Modules\Comment\Entities\DynamicComment;
use App\Modules\User\Entities\UserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DynamicCommentNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $dynamicComment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DynamicComment $dynamicComment)
    {
        // 注入回复实体，方便 toDatabase 方法中的使用
        $this->dynamicComment = $dynamicComment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = $this->dynamicComment;
        $dynamic = $comment->dynamic;
        // 如果评论人本身就是动态发布人，则不发送通知消息
        if ($dynamic->user_id == $comment->user_id){
            return;
        }
        $notify = Notify::insert([
            'notify_type'  => Notify::NOTIFY_TYPE['INTERACT_MSG'],
            'user_id'      => $dynamic->user_id,
            'target_id'    => $dynamic->dynamic_id,
            'target_type'  => Notify::TARGET_TYPE['DYNAMIC'],
            'sender_id'    => $comment->user_id,
            'sender_type'  => Notify::SYSTEM_SENDER,
            'dynamic_type' => $comment->reply_id == 0 ? Notify::DYNAMIC_TARGET_TYPE['COMMENT'] : Notify::DYNAMIC_TARGET_TYPE['REPLY_COMMENT'],
            'extend_id'    => $comment->comment_id,
        ]);
        if (!$notify) {
            throw new BadRequestException('互动`通知`消息录入失败！');
        }
        // 作者的通知数量累加1
        UserInfo::find($notify->user_id)->increment('notification_count');
        // 发送邮件通知
        if ($dynamic->user->user_email){
            Mail::to($dynamic->user->user_email)->send(
                new DynamicCommentNotify(
                    '您的动态`' . $dynamic->dynamic_title . '`有新的评论/回复',
                    route('dynamic.show', [$dynamic->dynamic_id, '#reply' . $comment->comment_id]),
                )
            );
        }
    }
}
