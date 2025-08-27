<?php

namespace App\Providers;

use App\Helpers\ConfigHelper;
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
    public function boot(): void
    {
        // Configurar mail dinamicamente se as configurações SMTP existirem na BD
        if ($this->app->runningInConsole()) {
            return;
        }

        try {
            $smtpConfig = ConfigHelper::getSmtpConfig();
            $cap = ConfigHelper::getRecaptchaConfig();
            
            if (!empty($smtpConfig['host'])) {
                config([
                    'mail.mailers.smtp.host' => $smtpConfig['host'],
                    'mail.mailers.smtp.port' => $smtpConfig['port'],
                    'mail.mailers.smtp.encryption' => $smtpConfig['encryption'],
                    'mail.mailers.smtp.username' => $smtpConfig['username'],
                    'mail.mailers.smtp.password' => $smtpConfig['password'],
                    'mail.from.address' => $smtpConfig['from']['address'],
                    'mail.from.name' => $smtpConfig['from']['name'],
                ]);
            }
        } catch (\Exception $e) {
            // Ignorar erros durante a inicialização
        }
    }
    
}
