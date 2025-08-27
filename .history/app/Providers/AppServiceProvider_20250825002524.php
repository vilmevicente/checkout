<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Configurar SMTP dinamicamente
        if ($this->app->environment('production')) {
            $this->configureDynamicSmtp();
        }
    }

    protected function configureDynamicSmtp()
    {
        config([
            'mail.mailers.smtp.host' => Configuration::getValue('smtp_host', config('mail.mailers.smtp.host')),
            'mail.mailers.smtp.port' => Configuration::getValue('smtp_port', config('mail.mailers.smtp.port')),
            'mail.mailers.smtp.username' => Configuration::getValue('smtp_username', config('mail.mailers.smtp.username')),
            'mail.mailers.smtp.password' => Configuration::getValue('smtp_password', config('mail.mailers.smtp.password')),
            'mail.mailers.smtp.encryption' => Configuration::getValue('smtp_encryption', config('mail.mailers.smtp.encryption')),
            'mail.from.address' => Configuration::getValue('smtp_from_address', config('mail.from.address')),
            'mail.from.name' => Configuration::getValue('smtp_from_name', config('mail.from.name')),
        ]);
    }
}
