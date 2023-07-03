<?php

namespace App\Modules\User\Entities;

use App\Models\Model;
use App\Modules\User\Entities\Traits\LastActivedAtHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserAuth extends Authenticatable implements JWTSubject
{
    use LastActivedAtHelper;
    // use Authenticatable;

    protected $primaryKey = 'user_id';
    protected $table = 'users';
    public $timestamps = false;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'login_token'
    ];
    protected $guarded = [];

    public function setPasswordAttribute($password = 123456)
    {
        $this->attributes['password'] = hash_make($password);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class, $this->primaryKey, $this->primaryKey);
    }

    public function userOtherlogin()
    {
        return $this->hasOne(UserOtherlogin::class, $this->primaryKey, $this->primaryKey);
    }

    public function userMoney()
    {
        return $this->hasOne(UserMoney::class, $this->primaryKey, $this->primaryKey);
    }

    // 会员通知设置
    public function userNotifySetting()
    {
        return $this->hasOne(UserNotifySetting::class, $this->primaryKey, $this->primaryKey);
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * 通过用户名搜索
     *
     * @param string $user_name
     *
     * @return mixed
     */
    public function getUserByName(string $user_name)
    {
        return $this->where('user_name', $user_name)->first();
    }

    /**
     * 通过邮箱进行搜索
     *
     * @param  string  $user_email
     *
     * @return mixed
     */
    public function getUserByEmail(string $user_email)
    {
        return $this->where('user_email', $user_email)->first();
    }

    /**
     * 通过手机号进行搜索
     *
     * @param  string  $user_mobile
     *
     * @return mixed
     */
    public function getUserByMobile(string $user_mobile)
    {
        return $this->where('user_mobile', $user_mobile)->first();
    }

    /**
     * 邮箱的激活链接
     *
     * @param $token
     *
     * @return string
     */
    public function getActivationLink($token)
    {
        return route('user.activate', ['verify_token' => $token]);
    }

    /**
     * 更改邮箱的激活链接
     *
     * @param $token
     *
     * @return string
     */
    public function getChangeEmailLink($token)
    {
        return route('user.activate_change_email', ['verify_token' => $token]);
    }

    public function isAuthorOf($model)
    {
        return $this->user_id == $model->user_id;
    }
}
