<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscribeDynamicToUserNotifySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_notify_settings', function (Blueprint $table) {
            $table->after('dynamic', function ($tableBuild){
                $tableBuild->json('subscribe_dynamic')->nullable()->comment('订阅动态的相关通知（站内信与邮箱）');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notify_settings', function (Blueprint $table) {
            $table->dropColumn('subscribe_dynamic');
        });
    }
}
