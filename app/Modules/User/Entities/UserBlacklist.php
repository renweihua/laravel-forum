<?php

namespace App\Modules\User\Entities;

use App\Exceptions\HttpStatus\SuccessRequestException;
use App\Models\Model;

class UserBlacklist extends Model
{
    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'user_id', 'user_id');
    }

    public function blackUserInfo()
    {
        return $this->belongsTo(UserInfo::class, 'black_user_id', 'user_id');
    }

    public static function getExistBlack($login_user_id, $black_user_id)
    {
        return UserBlacklist::where('user_id', $login_user_id)->where('black_user_id', $black_user_id)->first();
    }

    public static function setUserBlack($login_user_id, $black_user_id)
    {
        if ($login_user_id == $black_user_id){
            throw new SuccessRequestException('无需拉黑自己！');
        }
        if ($black = self::getExistBlack($login_user_id, $black_user_id)){
            return $black;
        }
        return self::create([
            'user_id' => $login_user_id,
            'black_user_id' => $black_user_id,
        ]);
    }
}
