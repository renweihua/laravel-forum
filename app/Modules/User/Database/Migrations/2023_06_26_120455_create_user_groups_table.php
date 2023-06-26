<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name = 'user_groups';
        if (Schema::hasTable($table_name)) return;
        Schema::create($table_name, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('group_name', 200)->default('')->comment('分组名称');
            $table->string('group_color', 200)->default('')->comment('分组颜色');
            $table->string('group_icon', 200)->default('')->comment('分组图标');
            $table->string('group_authority', 500)->default('')->comment('分组权限');
            $table->integer('permission_level')->unsigned()->default(1)->comment('权限级别：数字越小，级别越小');
            $table->boolean('is_enable')->unsigned()->default(1)->comment('是否启用：1：正常；0：关闭');
            $table->boolean('is_delete')->unsigned()->default(0)->comment('是否删除：1：是；0：否');
            $table->integer('created_time')->unsigned()->default(0)->comment('创建时间');
            $table->integer('updated_time')->unsigned()->default(0)->comment('更新时间');
            $table->index(['is_enable']);
            $table->index(['is_delete']);
            $table->index(['permission_level']);
        });
        // 设置表注释
        DB::statement("ALTER TABLE `" . env('DB_PREFIX') . $table_name . "` comment '会员分组权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_groups');
    }
}
