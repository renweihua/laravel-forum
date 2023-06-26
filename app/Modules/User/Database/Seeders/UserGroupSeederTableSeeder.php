<?php

namespace App\Modules\User\Database\Seeders;

use App\Constants\UserAuthority;
use App\Modules\User\Entities\UserGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserGroupSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // 设置默认会员组
        if (!UserGroup::where('permission_level', 1)->where('group_name', '默认会员组')->count()){
            $group_authority = array_keys(UserAuthority::BASE);
            UserGroup::create([
                'group_name' => '默认会员组',
                'group_color' => '#206bc4',
                'group_icon' => 'fa-group',
                'group_authority' => $group_authority,
                'permission_level' => 1,
                'is_enable' => 1,
            ]);
        }
    }
}
