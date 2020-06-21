<?php

namespace App\Providers;

use App\Http\Services\PaymentService;
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
