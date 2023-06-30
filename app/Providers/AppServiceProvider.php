<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->isLocal()) {
            // 切换登录会员工具
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 分页使用bootstrap
        Paginator::useBootstrap();

        // Paginator::defaultView('pagination::bootstrap-4');
        // Paginator::defaultSimpleView('pagination::simple-bootstrap-4');
    }
}
