<?php

namespace App\Modules\Comment\Entities;

use App\Models\Model;
use App\Modules\Forum\Entities\Dynamic;
use App\Modules\User\Entities\UserInfo;

class DynamicComment extends Model
{
    protected $primaryKey = 'comment_id';
    protected $is_delete = 0;
    protected $appends = ['comment_time', 'time_formatting'];

    protected static function boot()
    {
        parent::boot();

        // 新增与删除评论时，调用动态的统计缓存字段
        $saveContent = function (self $dynamicPraise) {
            $dynamicPraise->dynamic->refreshCache();
        };

        static::created($saveContent);

        static::deleted($saveContent);

        static::saving(function ($content) {
            if ($content->isDirty('comment_markdown') && !empty($content->comment_markdown)) {
                $content->comment_content = self::markdownToHtml($content->comment_markdown);
            }
        });
    }

    public function dynamic()
    {
        return $this->belongsTo(Dynamic::class, 'dynamic_id', 'dynamic_id');
    }

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'user_id', 'user_id');
    }

    public function replyUser()
    {
        return $this->belongsTo(UserInfo::class, 'reply_user', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(DynamicComment::class, 'top_level', $this->primaryKey);
    }

    public function hasPraise()
    {
        return $this->hasOne(DynamicCommentPraise::class, $this->primaryKey, $this->primaryKey);
    }

    public function isPraise()
    {
        return $this->hasOne(DynamicCommentPraise::class, $this->primaryKey, $this->primaryKey);
    }

    public function getCommentTimeAttribute($key)
    {
        return formatting_timestamp($this->attributes[self::CREATED_AT]);
    }

    public static function markdownToHtml(string $markdown)
    {
        return app(\Parsedown::class)->setBreaksEnabled(true)->setSafeMode(true)->text(\emoji($markdown));;
        return app(\ParsedownExtra::class)->text(\emoji($markdown));
    }

    public static function getListByIds(array $ids)
    {
        $list = self::whereIn('comment_id', $ids)->select('comment_id', 'comment_content', 'created_time')->get()->toArray();
        return array_column($list, null, 'comment_id');
    }
}
