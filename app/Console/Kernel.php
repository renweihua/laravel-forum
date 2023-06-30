<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // 一小时执行一次『活跃用户』数据生成的命令
        $schedule->command('larabbs:calculate-active-user')->hourly();
        // 每日零时执行一次
        $schedule->command('larabbs:sync-user-actived-at')->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        /**
         * 自动加载多模块的自定义命令行
         */
        $modules_path = config('modules.paths.modules');
        if ($dirs = get_dir_files($modules_path)){
            foreach ($dirs as $dir){
                if (is_dir($console_path = $modules_path . '/' . $dir . '/Console'))
                    $this->load($console_path = $modules_path . '/' . $dir . '/Console');
            }
        }

        require base_path('routes/console.php');
    }
}
