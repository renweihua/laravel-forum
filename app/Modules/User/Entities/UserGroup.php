<?php

namespace App\Modules\User\Entities;

use App\Models\Model;

// 会员分组权限表
class UserGroup extends Model
{
    protected $casts = [
        'group_authority' => 'array'
    ];
}
