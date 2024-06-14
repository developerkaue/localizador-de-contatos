<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\ValidCpf;
use Illuminate\Support\Facades\Validator;
use App\Services\Http\EmailConfigService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('email-config', function () {
            return new EmailConfigService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            return (new ValidCpf)->passes($attribute, $value);
        });
        
    }
}
