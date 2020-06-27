<?php

namespace App\Providers;

use App\Http\Services\PaymentService;
use App\Http\Services\SortService;
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
        $this->app->singleton(PaymentService::class, function () {
            return new PaymentService(
                env('CLOUDPAYMENTS_BASEURL'),
                env('CLOUDPAYMENTS_USERNAME'),
                env('CLOUDPAYMENTS_PASSWORD')
            );
        });
        $this->app->bind(SortService::class, function () {
            return new SortService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
