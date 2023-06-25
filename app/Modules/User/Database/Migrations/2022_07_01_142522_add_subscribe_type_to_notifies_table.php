<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscribeTypeToNotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifies', function (Blueprint $table) {
            $table->after('dynamic_type', function ($tableBuild){
                $tableBuild->integer('subscribe_type')->unsigned()->default(0)->comment('订阅类型：0.话题；1.动态');
            });
            $table->index('target_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifies', function (Blueprint $table) {
            $table->dropColumn('subscribe_type');
            $table->dropIndex('target_type');
        });
    }
}
