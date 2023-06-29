<?php

namespace App\Modules\Forum\Entities;

use App\Models\Model;
use App\Modules\Forum\Constants\DynamicCacheKeys;
use App\Modules\Topic\Entities\Topic;
use App\Modules\User\Entities\User;
use App\Modules\User\Entities\UserInfo;
use App\Modules\User\Entities\UserOtherlogin;
use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Dynamic extends Model
{
    use Filterable;
    use HasFactory;

    // 内容格式类型
    const CONTENT_TYPE_MARKDOWN = 'markdown';
    const CONTENT_TYPE_HTML = 'html';

    protected $fillable = [];

    protected static function newFactory()
    {
        return \App\Modules\Forum\Database\factories\DynamicFactory::new();
    }

    // 时间戳格式化
    public function getTimeFormattingAttribute($value)
    {
        if(!isset($this->attributes['created_time'])) return '';
        return formatting_timestamp($this->attributes['created_time'], false);
    }

    public function getLastTimeFormattingAttribute($value)
    {
        if(!isset($this->attributes['updated_time'])) return '';
        return formatting_timestamp($this->attributes['updated_time'], false);
    }

    protected $primaryKey = 'dynamic_id';
    protected $is_delete  = 0;
    protected $appends = ['time_formatting', 'last_time_formatting', 'dynamic_type_text'];

    protected static function boot()
    {
        parent::boot();

        // 更新一下`话题`缓存
        $updateTopicsCache = function($dynamic){
            Topic::clearTopicsCache();

            if ($dynamic->content_type == self::CONTENT_TYPE_MARKDOWN && $dynamic->isDirty('dynamic_markdown')) {
                $dynamic->dynamic_content = self::toHTML($dynamic->dynamic_markdown);
            }

            if ($dynamic->content_type == self::CONTENT_TYPE_HTML && $dynamic->isDirty('dynamic_content')) {
                $dynamic->dynamic_markdown = self::htmlToMarkdown($dynamic->dynamic_content);
            }
        };

        // 新增与删除动态时，调用会员的统计缓存字段
        $saveContent = function ($dynamic) use ($updateTopicsCache){
            $dynamic->userInfo->refreshCache();

            $updateTopicsCache($dynamic);

            // 清除动态的所有缓存
            self::getDynamicById($dynamic->dynamic_id, -1 ,true);
        };

        static::created($saveContent);

        static::deleted($saveContent);

        static::saved($updateTopicsCache);

        static::updated($updateTopicsCache);

        // static::saved(function ($content) {
        //     \dispatch(new FetchContentMentions($content));
        // });
    }

    /**
     * 只查询 启用 的作用域
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCheck($query)
    {
        return $query->where('is_check', 1);
    }

    public function scopePublic($query, int $is_public = 1, bool $is_api = true)
    {
        $query->where('is_public', $is_public);
        // 如果是登录会员，自己的`未公开`或`加密`的动态也需要展示
        if ($is_api && $is_public == 1){
            $login_user_id = getLoginUserId();
            if ($login_user_id){
                $query->orWhere(function ($q) use($login_user_id){
                    $q->where([
                        'user_id' => $login_user_id
                    ]);
                });
            }
        }
        return $query;
    }

    // 统计扩展字段
    const CACHE_EXTENDS_FIELDS = [
        'reads_num' => 0, // 浏览量
        'comments_count' => 0, // 评论数量
        'praises_count' => 0, // 点赞数量
        'collections_count' => 0, // 收藏数量
    ];

    public function getCacheExtendsAttribute()
    {
        return \array_merge(self::CACHE_EXTENDS_FIELDS, json_decode($this->attributes['cache_extends'] ?? '{}', true));
    }

    public function setCacheExtendsAttribute($value)
    {
        $this->attributes['cache_extends'] = my_json_encode(array_merge(json_decode($this->attributes['cache_extends'] ?? '{}', true), $value));
    }

    // 刷新统计数据
    public function refreshCache()
    {
        $this->update(['cache_extends' => \array_merge(self::CACHE_EXTENDS_FIELDS, [
            'reads_num' => (int)$this->cache_extends['reads_num'],
            'comments_count' => $this->comments()->count(),
            'praises_count' => $this->praises()->count(),
            'collections_count' => $this->collection()->count(),
        ])]);
    }

    /**
     * 获取多图，自动转成数组
     *
     * @param $images
     * @return false|string[]
     */
    public function getDynamicImagesAttribute($images)
    {
        if (empty($images)) return [];
        if (is_string($images)) {
            $images = explode(',', $images);
        }
        foreach ($images as &$img) {
            if (!check_url($img)){
                $img = Storage::url($img);
            }
        }
        return $images;
    }

    /**
     * 设置动态的图片
     *
     * @param $key
     */
    public function setDynamicImagesAttribute($key)
    {
        if ( !empty($key)) {
            if (is_string($key)) {
                $key = explode(',', $key);
            }
            foreach ($key as &$value) {
                $value = str_replace(Storage::url('/'), '', $value);
            }
            $this->attributes['dynamic_images'] = implode(',', $key);
        }
    }

    /**
     * 获取视频地址
     *
     * @param $value
     *
     * @return string
     */
    public function getVideoPathAttribute($value)
    {
        if (empty($value)) return '';
        if (check_url($value)){
            return $value;
        }
        return Storage::url($value);
    }

    /**
     * 设置动态的视频地址
     *
     * @param $value
     */
    public function setVideoPathAttribute($value)
    {
        if ( !empty($value)) {
            $this->attributes['video_path'] = str_replace(Storage::url('/'), '', $value);
        }
    }

    /**
     * 获取视频信息
     *
     * @param $value
     *
     * @return mixed|object
     */
    public function getVideoInfoAttribute($value)
    {
        if (empty($value)) return (object)[];
        return my_json_decode($value);
    }

    /**
     * 设置视频信息
     *
     * @param $value
     */
    public function setVideoInfoAttribute($value)
    {
        $this->attributes['video_info'] = my_json_encode($value);
    }

    /**
     * 获取动态类型文本
     *
     * @return string
     */
    public function getDynamicTypeTextAttribute(): string
    {
        $text = '动态';
        if (!isset($this->attributes['dynamic_type'])) return $text;
        switch ($this->attributes['dynamic_type']){
            case 1: // 图文
                $text = '图文';
                break;
            case 2: // 视频
                $text = '视频';
                break;
            case 3: // 摄影/相册
                $text = '相册';
                break;
        }
        return $text;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'user_id', 'user_id');
    }

    public function userOtherLogin()
    {
        return $this->belongsTo(UserOtherlogin::class, 'user_id', 'user_id');
    }

    // 是否订阅
    public function isSubscribe()
    {
        return $this->hasOne(SubscribeDynamic::class, $this->primaryKey, $this->primaryKey);
    }

    // 是否收藏
    public function isCollection()
    {
        return $this->hasOne(DynamicCollection::class, $this->primaryKey, $this->primaryKey);
    }

    // 收藏
    public function collection()
    {
        return $this->hasMany(DynamicCollection::class, $this->primaryKey, $this->primaryKey);
    }

    // 是否点赞
    public function isPraise()
    {
        return $this->hasOne(DynamicPraise::class, $this->primaryKey, $this->primaryKey);
    }

    // 点赞
    public function praises()
    {
        return $this->hasMany(DynamicPraise::class, $this->primaryKey, $this->primaryKey);
    }

    // 评论
    public function comments()
    {
        return $this->hasMany(DynamicComment::class, $this->primaryKey, $this->primaryKey);
    }

    /**
     * 发布人是谁的关注人
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fanUser()
    {
        return $this->hasOne(UserFollowFan::class, 'friend_id', 'user_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'topic_id')->select('topic_id', 'topic_name', 'topic_description', 'topic_cover');
    }

    public static function getListByIds(array $ids)
    {
        $list = self::whereIn('dynamic_id', $ids)->select('dynamic_id', 'dynamic_title', 'dynamic_images', 'dynamic_type', 'created_time')->get()->toArray();
        return array_column($list, null, 'dynamic_id');
    }

    public static function toHTML(string $markdown)
    {
        $convertedHmtl = app(\ParsedownExtra::class)->setBreaksEnabled(true)->text(\emoji($markdown));

        /** XSS 防注入 */
        $convertedHmtl = Purifier::clean($convertedHmtl, 'markdown');

        // 代码高亮展示优化
        $convertedHmtl = str_replace("<pre><code>", '<pre><code class=" language-php">', $convertedHmtl);

        return $convertedHmtl;
    }

    /**
     * html -> markdown;
     * @param $html
     * @return string
     */
    public static function htmlToMarkdown($html)
    {
        $converter = new HtmlConverter(['header_style' => 'atx']);

        $converter->getConfig()->setOption('list_item_style', '*');

        // 默认情况下，br标记按照传统的Markdown转换为两个空格，后跟一个换行符。根据GitHub口味的Markdown（GFM），将hard_break设置为true，以省略这两个空格
        $converter->getConfig()->setOption('hard_break', true);

        return $converter->convert($html);
    }

    // 获取会员的动态数量
    public static function getDynamicsTotalByUser($user_id): int
    {
        return (int)self::where('user_id', $user_id)->count();
    }

    // 通过动态Id获取动态（如果存在于缓存，则读取缓存；否则读取数据库）
    public static function getDynamicById(int $dynamic_id, int $login_user_id = 0, bool $force = false)
    {
        $key = DynamicCacheKeys::getDynamicCacheKey($dynamic_id, $login_user_id);
        $tag_key = 'dynamic:tag:detail:' . $dynamic_id;
        if (!Cache::tags($tag_key)->has($key) || $force) {
            // 清除该动态的所有缓存
            if($login_user_id == -1){
                Cache::tags($tag_key)->delete($key);
                return;
            }
            $dynamic = Dynamic::check()->with([
                'userInfo' => function($query) use($login_user_id){
                    $query->select(['user_id', 'nick_name', 'user_avatar', 'user_sex', 'user_grade', 'city_info', 'user_uuid', 'basic_extends', 'other_extends'])->with([
                        'isFollow' => function($query) use ($login_user_id) {
                            $query->where('user_id', $login_user_id);
                        }
                    ]);
                },
                'userOtherLogin' => function($query){
                    $query->select(['user_id', 'qq_info', 'weibo_info', 'github_info']);
                },
                'topic'
            ])->find($dynamic_id);
            if (empty($dynamic)) {
                throw new \Exception('动态不存在！');
            }
            Cache::tags($tag_key)->put($key, $dynamic, Carbon::now()->addMinutes(10));
        } else {
            $dynamic = Cache::tags($tag_key)->get($key);
        }
        if (empty($dynamic)) {
            throw new \Exception('动态不存在！');
        }
        return $dynamic;
    }
}
