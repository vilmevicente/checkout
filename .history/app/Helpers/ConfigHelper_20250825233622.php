<?php
// app/Helpers/ConfigHelper.php

namespace App\Helpers;

use App\Models\Configuration;

class ConfigHelper
{
    /**
     * Obter valor de configuração
     */
    public static function get($key, $default = null)
    {
        return Configuration::getValue($key, $default);
    }

    /**
     * Obter configurações SMTP
     */
    public static function getSmtpConfig()
    {
        return [
            'host' => self::get('smtp_host', config('mail.mailers.smtp.host')),
            'port' => self::get('smtp_port', config('mail.mailers.smtp.port')),
            'username' => self::get('smtp_username', config('mail.mailers.smtp.username')),
            'password' => self::get('smtp_password', config('mail.mailers.smtp.password')),
            'encryption' => self::get('smtp_encryption', config('mail.mailers.smtp.encryption')),
            'from' => [
                'address' => self::get('smtp_from_address', config('mail.from.address')),
                'name' => self::get('smtp_from_name', config('mail.from.name')),
            ],
        ];
    }

    /**
     * Obter configurações do Facebook Pixel
     */
    public static function getFacebookPixelConfig()
    {
        return [
            'enabled' => (bool) self::get('facebook_pixel_enabled', false),
            'pixel_id' => self::get('facebook_pixel_id', ''),
            'access_token' => self::get('facebook_access_token', ''),
        ];
    }

    /**
     * Obter configurações do reCAPTCHA
     */
    public static function getRecaptchaConfig()
    {
        return [
            'enabled' => (bool) self::get('recaptcha_enabled', false),
            'site_key' => self::get('recaptcha_site_key', ''),
            'secret_key' => self::get('recaptcha_secret_key', ''),
        ];
    }

    /**
     * Obter configurações de checkout
     */
    public static function getCheckoutConfig()
    {
        return [
            'timeout_minutes' => self::get('checkout_timeout_minutes', 30),
            'max_upsells' => self::get('max_upsells_per_order', 3),
            'copyright_text' => self::get('copyright_text', ''),
            'company_name' => self::get('company_name', ''),
            'retailer_name' => self::get('retailer_name', ''),
        ];
    }

    /**
     * Verificar se Facebook Pixel está ativo
     */
    public static function isFacebookPixelEnabled()
    {
        return (bool) self::get('facebook_pixel_enabled', false);
    }

    /**
     * Verificar se reCAPTCHA está ativo
     */
    public static function isRecaptchaEnabled()
    {
        return (bool) self::get('recaptcha_enabled', false);
    }


        public static function isGooglePixelEnabled()
    {
        return (bool) self::get('google_pixel_enabled', false);
    }

}