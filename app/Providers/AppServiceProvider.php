<?php

namespace App\Providers;

use App\Services\InstallmentPayment\Impl\InstallmentPaymentService;
use App\Services\InstallmentPayment\InstallmentPaymentServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind( InstallmentPaymentServiceInterface::class, InstallmentPaymentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
