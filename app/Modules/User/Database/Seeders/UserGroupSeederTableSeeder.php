<?php

namespace App\Modules\User\Database\Seeders;

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
            UserGroup::create([
                'group_name' => '默认会员组',
                'group_color' => '#206bc4',
                'group_icon' => 'fa-user',
                'group_authority' => '["comment_caina","comment_create","comment_edit","comment_remove","report_comment","report_topic","topic_create","topic_delete","topic_edit","topic_tag_create"]',
                'permission_level' => 1,
                'is_enable' => 1,
            ]);
        }
    }
}
