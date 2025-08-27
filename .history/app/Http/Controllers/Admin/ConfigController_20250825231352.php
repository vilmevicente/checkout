<?php

namespace App\Http\Controllers\Admin;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function edit()
    {
        $configs = Configuration::all()->keyBy('key');
        return view('admin.config.edit', compact('configs'));
    }

    public function update(Request $request)
    {


        $validated = $request->validate([
            'checkout_timeout_minutes' => 'required|integer|min:1|max:60',
            'max_upsells_per_order' => 'required|integer|min:1|max:10',
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer|min:1|max:65535',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_encryption' => 'nullable|in:tls,ssl,',
            'smtp_from_address' => 'nullable|email|max:255',
            'smtp_from_name' => 'nullable|string|max:255',
            'copyright_text' => 'nullable|string',
            'facebook_pixel_enabled' => 'nullable|in:0,1,on,off',
            'facebook_pixel_id' => 'nullable|string|max:255',
            'facebook_access_token' => 'nullable|string|max:255',
            'recaptcha_enabled' => 'nullable|in:0,1,on,off',
            'recaptcha_site_key' => 'nullable|string|max:255',
            'recaptcha_secret_key' => 'nullable|string|max:255',
        ]);

       


        // Processar as configurações que serão salvas no banco de dados
        foreach ($validated as $key => $value) {
            if ($key === 'smtp_password' && empty($value)) {
                // Não atualizar a senha se estiver vazia
                continue;
            }


                if (in_array($key, ['recaptcha_enabled', 'facebook_pixel_enabled'])) {
        $value = ($value=='on') ? 1 : 0;
    }
            
            Configuration::setValue($key, $value);
        }

        // Configurações para salvar no .env
        $envUpdates = [];
        
        // Facebook Pixel
        if (isset($validated['facebook_pixel_id'])) {
            $envUpdates['FACEBOOK_PIXEL_ID'] = $validated['facebook_pixel_id'];
        }
        
        if (isset($validated['facebook_access_token'])) {
            $envUpdates['FACEBOOK_ACCESS_TOKEN'] = $validated['facebook_access_token'];
        }
        
        // reCAPTCHA
        if (isset($validated['recaptcha_site_key'])) {
            $envUpdates['RECAPTCHA_SITE_KEY'] = $validated['recaptcha_site_key'];
        }
        
        if (isset($validated['recaptcha_secret_key'])) {
            $envUpdates['RECAPTCHA_SECRET_KEY'] = $validated['recaptcha_secret_key'];
        }
        
        // SMTP (opcional - se quiser manter no .env também)
        if (isset($validated['smtp_host'])) {
            $envUpdates['MAIL_HOST'] = $validated['smtp_host'];
        }
        
        if (isset($validated['smtp_port'])) {
            $envUpdates['MAIL_PORT'] = $validated['smtp_port'];
        }
        
        if (isset($validated['smtp_username'])) {
            $envUpdates['MAIL_USERNAME'] = $validated['smtp_username'];
        }
        
        if (isset($validated['smtp_password']) && !empty($validated['smtp_password'])) {
            $envUpdates['MAIL_PASSWORD'] = $validated['smtp_password'];
        }
        
        if (isset($validated['smtp_encryption'])) {
            $envUpdates['MAIL_ENCRYPTION'] = $validated['smtp_encryption'];
        }
        
        if (isset($validated['smtp_from_address'])) {
            $envUpdates['MAIL_FROM_ADDRESS'] = $validated['smtp_from_address'];
        }
        
        if (isset($validated['smtp_from_name'])) {
            $envUpdates['MAIL_FROM_NAME'] = $validated['smtp_from_name'];
        }
        
        // Atualizar arquivo .env se houver mudanças
        if (!empty($envUpdates)) {
            $this->updateEnv($envUpdates);
            
            // Limpar cache de configuração
            Artisan::call('config:clear');
        }

        return redirect()->route('admin.config.edit')
            ->with('success', 'Configurações atualizadas com sucesso!');
    }

    public function testSmtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'host' => 'required|string',
            'port' => 'required|integer',
            'username' => 'required|string',
            'password' => 'required|string',
            'encryption' => 'nullable|in:tls,ssl,',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados de conexão incompletos.'
            ]);
        }

        try {
            $transport = new EsmtpTransport(
                $request->host,
                $request->port,
                $request->encryption ?: false
            );

            $transport->setUsername($request->username);
            $transport->setPassword($request->password);
            
            // Testar conexão
            $transport->start();
            $transport->stop();

            return response()->json([
                'success' => true,
                'message' => 'Conexão SMTP realizada com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro na conexão SMTP: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Atualiza o arquivo .env com as novas configurações
     *
     * @param array $values
     * @return void
     */
    protected function updateEnv(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        
        foreach ($values as $key => $value) {
            // Escapar caracteres especiais para o ambiente
            $value = str_replace('"', '\"', $value);
            
            // Padrão para buscar a chave no arquivo .env
            $keyPattern = "/^{$key}=.*/m";
            
            if (preg_match($keyPattern, $str)) {
                // Se a chave já existe, substituir
                $str = preg_replace(
                    $keyPattern,
                    "{$key}=\"{$value}\"",
                    $str
                );
            } else {
                // Se a chave não existe, adicionar no final
                $str .= "\n{$key}=\"{$value}\"";
            }
        }
        
        file_put_contents($envFile, $str);
    }
}