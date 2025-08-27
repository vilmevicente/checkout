<?php

namespace App\Http\Controllers\Admin;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

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
        ]);

        foreach ($validated as $key => $value) {
            if ($key === 'smtp_password' && empty($value)) {
                // Não atualizar a senha se estiver vazia
                continue;
            }
            
            Configuration::setValue($key, $value);
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
}