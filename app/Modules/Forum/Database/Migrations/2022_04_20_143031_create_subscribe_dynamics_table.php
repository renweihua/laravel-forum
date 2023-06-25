<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribeDynamicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('subscribe_dynamics')) return;
        Schema::create('subscribe_dynamics', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('dynamic_id')->unsigned()->default(0)->comment('动态Id');
            $table->bigInteger('user_id')->unsigned()->default(0)->comment('会员Id');
            $table->string('created_ip', 20)->default('')->comment('创建IP');
            $table->string('browser_type', 300)->default('')->comment('创建时浏览器类型');
            $table->integer('created_time')->unsigned()->default(0)->comment('创建时间');
            $table->integer('updated_time')->unsigned()->default(0)->comment('更新时间');
            // 复合/联合 索引，必须以 动态Id 作为第一列/最左（最左匹配原则）
            $table->index(['dynamic_id', 'user_id']);
        });
        // 设置表注释
        DB::statement("ALTER TABLE `" . env('DB_PREFIX') . "subscribe_dynamics` comment '订阅动态表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribe_dynamics');
    }
}
