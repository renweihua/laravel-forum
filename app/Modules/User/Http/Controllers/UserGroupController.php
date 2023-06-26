<?php

namespace App\Modules\User\Http\Controllers;

use App\Constants\UserAuthority;
use App\Modules\User\Entities\User;
use App\Modules\User\Entities\UserGroup;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserGroupController extends Controller
{
    public function group(Request $request)
    {
        $users = User::with('userInfo')->orderByDesc('user_id')->paginate(10);

        // 分组信息
        $group = UserGroup::first();
        // 分组权限
        $show_group_authorities = [];
        foreach ($group->group_authority as $authority_key){
            if (isset(UserAuthority::BASE[$authority_key])){
                $show_group_authorities[] = [
                    'key' => $authority_key,
                    'value' => UserAuthority::BASE[$authority_key],
                ];
            }
        }

        return view('user::group', compact('group', 'show_group_authorities', 'users'));
    }
}
