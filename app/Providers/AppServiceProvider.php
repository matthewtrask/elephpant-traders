<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $monolog = Log::getMonolog();
        $syslog = new \Monolog\Handler\SyslogHandler('papertrail');
        $formatter = new \Monolog\Formatter\LineFormatter('%channel%.%level_name%: %message% %extra%');
        $syslog->setFormatter($formatter);

        $monolog->pushHandler($syslog);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
