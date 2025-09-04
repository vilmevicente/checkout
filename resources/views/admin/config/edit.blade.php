@extends('layouts.app')

@section('title', 'Configurações do Checkout')

@section('content')
<div class="bg-white shadow rounded-lg max-w-4xl mx-auto">
     <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow rounded-lg max-w-4xl mx-auto">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-6">Configurações do Checkout</h3>

                <form action="{{ route('admin.config.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Seção de Configurações Gerais -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium text-gray-900 mb-4 border-b pb-2">Configurações Gerais</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Checkout Timeout -->
                            <div>
                                <label for="checkout_timeout_minutes" class="block text-sm font-medium text-gray-700">
                                    Tempo limite do checkout (minutos)
                                </label>
                                <input type="number" name="checkout_timeout_minutes" id="checkout_timeout_minutes" min="1" max="60"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('checkout_timeout_minutes', $configs['checkout_timeout_minutes']->value ?? '') }}">
                                <p class="mt-1 text-sm text-gray-500">Tempo máximo para finalizar a compra.</p>
                            </div>

                            <!-- Max Upsells -->
                            <div>
                                <label for="max_upsells_per_order" class="block text-sm font-medium text-gray-700">
                                    Máximo de upsells por pedido
                                </label>
                                <input type="number" name="max_upsells_per_order" id="max_upsells_per_order" min="1" max="10"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('max_upsells_per_order', $configs['max_upsells_per_order']->value ?? '') }}">
                                <p class="mt-1 text-sm text-gray-500">Número máximo de upsells permitidos.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Seção de Copyright -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium text-gray-900 mb-4 border-b pb-2">Texto de Copyright</h4>
                        
                        <div>
                            <label for="copyright_text" class="block text-sm font-medium text-gray-700">
                                Texto de Copyright
                            </label>
                            <textarea name="copyright_text" id="copyright_text" rows="4"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Ex: By clicking &quot;Pay&quot;, I declare that...">{{ old('copyright_text', $configs['copyright_text']->value ?? '') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">
                                Texto exibido no checkout com informações de copyright e termos.
                            </p>
                        </div>

                  
<!-- Facebook Pixel -->
<div class="flex items-center mb-4">
    <div class="relative inline-block w-10 mr-2 align-middle select-none">
        <input type="hidden" name="facebook_pixel_enabled" value="0">

        <input 
            type="checkbox"
            name="facebook_pixel_enabled"
            id="facebook_pixel_enabled"
            value="1"
            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
            {{ old('facebook_pixel_enabled', $configs['facebook_pixel_enabled']->value ?? 0) == 1 ? 'checked' : '' }}
        >
        <label for="facebook_pixel_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
    </div>
    <label for="facebook_pixel_enabled" class="text-sm font-medium text-gray-700">
        Ativar Facebook Pixel
    </label>
</div>

<div id="facebook-pixel-fields">
    <div>
        <label for="facebook_pixel_id" class="block text-sm font-medium text-gray-700">
            Pixel ID
        </label>
        <input type="text" name="facebook_pixel_id" id="facebook_pixel_id"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
               value="{{ old('facebook_pixel_id', $configs['facebook_pixel_id']->value ?? '') }}"
               placeholder="Ex: 123456789012345">
        <p class="mt-1 text-sm text-gray-500">ID do seu Facebook Pixel.</p>
    </div>

    <div class="mt-4">
        <label for="facebook_access_token" class="block text-sm font-medium text-gray-700">
            Access Token (Opcional)
        </label>
        <input type="password" name="facebook_access_token" id="facebook_access_token"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
               value="{{ old('facebook_access_token', $configs['facebook_access_token']->value ?? '') }}"
               placeholder="Token de acesso do Facebook">
        <p class="mt-1 text-sm text-gray-500">Necessário para eventos personalizados.</p>
    </div>
</div>


<!-- Google Pixel -->
<div class="flex items-center mb-4">
    <div class="relative inline-block w-10 mr-2 align-middle select-none">
        <input type="hidden" name="google_pixel_enabled" value="0">

        <input 
            type="checkbox"
            name="google_pixel_enabled"
            id="google_pixel_enabled"
            value="1"
            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
            {{ old('google_pixel_enabled', $configs['google_pixel_enabled']->value ?? 0) == 1 ? 'checked' : '' }}
        >
        <label for="google_pixel_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
    </div>
    <label for="google_pixel_enabled" class="text-sm font-medium text-gray-700">
        Ativar Google Pixel
    </label>
</div>

<div id="google-pixel-fields">
    <div>
        <label for="google_pixel_id" class="block text-sm font-medium text-gray-700">
            Google Tag Manager ID
        </label>
        <input type="text" name="google_pixel_id" id="google_pixel_id"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
               value="{{ old('google_pixel_id', $configs['google_pixel_id']->value ?? '') }}"
               placeholder="Ex: GTM-XXXXXX">
        <p class="mt-1 text-sm text-gray-500">ID do seu Google Pixel ou GTM.</p>
    </div>
</div>


                    <!-- Seção reCAPTCHA -->
       <!-- reCAPTCHA -->
<div class="flex items-center mb-4">
    <div class="relative inline-block w-10 mr-2 align-middle select-none">
     <input type="hidden" name="recaptcha_enabled" value="0">    
    <input 
            type="checkbox"
            name="recaptcha_enabled"
            id="recaptcha_enabled"
            value="1"
            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
            {{ old('recaptcha_enabled', $configs['recaptcha_enabled']->value ?? 0) == 1 ? 'checked' : '' }}
        >
        <label for="recaptcha_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
    </div>
    <label for="recaptcha_enabled" class="text-sm font-medium text-gray-700">
        Ativar reCAPTCHA
    </label>
</div>
                        
                        <div id="recaptcha-fields">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="recaptcha_site_key" class="block text-sm font-medium text-gray-700">
                                        Site Key
                                    </label>
                                    <input type="text" name="recaptcha_site_key" id="recaptcha_site_key"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                           value="{{ old('recaptcha_site_key', $configs['recaptcha_site_key']->value ?? '') }}"
                                           placeholder="Chave pública do reCAPTCHA">
                                </div>

                                <div>
                                    <label for="recaptcha_secret_key" class="block text-sm font-medium text-gray-700">
                                        Secret Key
                                    </label>
                                    <input type="password" name="recaptcha_secret_key" id="recaptcha_secret_key"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                           value="{{ old('recaptcha_secret_key', $configs['recaptcha_secret_key']->value ?? '') }}"
                                           placeholder="Chave secreta do reCAPTCHA">
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Este site é protegido por reCAPTCHA e está sujeito à 
                                <a href="https://policies.google.com/privacy" class="text-indigo-600 hover:text-indigo-500" target="_blank">Política de Privacidade</a> e 
                                <a href="https://policies.google.com/terms" class="text-indigo-600 hover:text-indigo-500" target="_blank">Termos de Serviço</a> do Google.
                            </p>
                        </div>
                    </div>




 <!-- Seção Modelos de E-mail -->
                    <div class="mb-8 border-t border-gray-200 pt-6">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Modelos de E-mail</h4>

                        <!-- Confirmação de Pedido -->
                        <div class="mb-6">
                            <label for="order_confirmation_template" class="block text-sm font-medium text-gray-700">
                                Modelo de Confirmação de Pedido
                            </label>
                            <textarea 
                                name="order_confirmation_template" 
                                id="order_confirmation_template" 
                                rows="8"
                                class="html-editor mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 font-mono focus:ring-indigo-500 focus:border-indigo-500"
                            >{!! old('order_confirmation_template', $configs['order_confirmation_template']->value ?? '') !!}</textarea>
                            <p class="mt-1 text-sm text-gray-500">
                                Variáveis disponíveis: <code>{{ '{' }}{ $order->customer_name }}</code>, 
                                <code>{{ '{' }}{ $order->reference }}</code>, 
                                <code>{{ '{' }}{ $order->total }}</code>.
                            </p>
                        </div>

                        <!-- Envio de Conteúdo -->
                        <div>
                            <label for="content_delivery_template" class="block text-sm font-medium text-gray-700">
                                Modelo de Envio de Conteúdo
                            </label>
                            <textarea 
                                name="content_delivery_template" 
                                id="content_delivery_template" 
                                rows="8"
                                class="html-editor mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 font-mono focus:ring-indigo-500 focus:border-indigo-500"
                            >{!! old('content_delivery_template', $configs['content_delivery_template']->value ?? '') !!}</textarea>
                            <p class="mt-1 text-sm text-gray-500">
                                Variáveis disponíveis: <code>{{ '{' }}{ $user->name }}</code>, 
                                <code>{{ '{' }}{ $content->title }}</code>, 
                                <code>{{ '{' }}{ $content->link }}</code>.
                            </p>
                        </div>
                    </div>





                    <!-- Configurações SMTP -->
                    <div class="mb-8 border-t border-gray-200 pt-6">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Configurações SMTP</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- SMTP Host -->
                            <div>
                                <label for="smtp_host" class="block text-sm font-medium text-gray-700">
                                    SMTP Host
                                </label>
                                <input type="text" name="smtp_host" id="smtp_host"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('smtp_host', $configs['smtp_host']->value ?? '') }}"
                                       placeholder="smtp.gmail.com">
                            </div>

                            <!-- SMTP Port -->
                            <div>
                                <label for="smtp_port" class="block text-sm font-medium text-gray-700">
                                    SMTP Port
                                </label>
                                <input type="number" name="smtp_port" id="smtp_port" min="1" max="65535"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('smtp_port', $configs['smtp_port']->value ?? '587') }}"
                                       placeholder="587">
                            </div>

                            <!-- SMTP Username -->
                            <div>
                                <label for="smtp_username" class="block text-sm font-medium text-gray-700">
                                    SMTP Username
                                </label>
                                <input type="text" name="smtp_username" id="smtp_username"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('smtp_username', $configs['smtp_username']->value ?? '') }}"
                                       placeholder="seu@email.com">
                            </div>

                            <!-- SMTP Password -->
                            <div>
                                <label for="smtp_password" class="block text-sm font-medium text-gray-700">
                                    SMTP Password
                                </label>
                                <input type="password" name="smtp_password" id="smtp_password"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('smtp_password', $configs['smtp_password']->value ?? '') }}"
                                       placeholder="Sua senha SMTP">
                                <p class="mt-1 text-sm text-gray-500">Deixe em branco para manter a senha atual.</p>
                            </div>

                            <!-- SMTP Encryption -->
                            <div>
                                <label for="smtp_encryption" class="block text-sm font-medium text-gray-700">
                                    Encryption
                                </label>
                                <select name="smtp_encryption" id="smtp_encryption"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">None</option>
                                    <option value="tls" {{ (old('smtp_encryption', $configs['smtp_encryption']->value ?? '') == 'tls') ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ (old('smtp_encryption', $configs['smtp_encryption']->value ?? '') == 'ssl') ? 'selected' : '' }}>SSL</option>
                                </select>
                            </div>

                            <!-- SMTP From Address -->
                            <div>
                                <label for="smtp_from_address" class="block text-sm font-medium text-gray-700">
                                    From Address
                                </label>
                                <input type="email" name="smtp_from_address" id="smtp_from_address"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('smtp_from_address', $configs['smtp_from_address']->value ?? '') }}"
                                       placeholder="no-reply@seudominio.com">
                            </div>

                            <!-- SMTP From Name -->
                            <div>
                                <label for="smtp_from_name" class="block text-sm font-medium text-gray-700">
                                    From Name
                                </label>
                                <input type="text" name="smtp_from_name" id="smtp_from_name"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       value="{{ old('smtp_from_name', $configs['smtp_from_name']->value ?? config('app.name')) }}"
                                       placeholder="Nome da Loja">
                            </div>
                        </div>

                        <!-- Test SMTP Connection -->
                        <div class="mt-4">
                            <button type="button" id="test-smtp" 
                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                                Testar Conexão SMTP
                            </button>
                            <div id="smtp-test-result" class="mt-2 hidden"></div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                            Voltar
                        </a>
                        <button type="submit" 
                                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Salvar Configurações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    document.querySelectorAll('.html-editor').forEach((el) => {
        ClassicEditor
            .create(el, {
                toolbar: [
                    'undo','redo','|',
                    'heading','|',
                    'bold','italic','underline',,'|',
                    
                    
                ],
                
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>


    <script>
        // Toggle para mostrar/ocultar campos do Facebook Pixel
        const facebookPixelToggle = document.getElementById('facebook_pixel_enabled');
        const facebookPixelFields = document.getElementById('facebook-pixel-fields');
        
        // Toggle para mostrar/ocultar campos do reCAPTCHA
        const recaptchaToggle = document.getElementById('recaptcha_enabled');
        const recaptchaFields = document.getElementById('recaptcha-fields');


        // Toggle para mostrar/ocultar campos do Google Pixel
        const googleToggle = document.getElementById('google_pixel_enabled');
        const googleFields = document.getElementById('google-pixel-fields');
        
        // Função para atualizar a visibilidade dos campos
        function updateFieldsVisibility() {
            if (facebookPixelToggle.checked) {
                facebookPixelFields.style.display = 'block';
            } else {
                facebookPixelFields.style.display = 'none';
            }
            
            if (recaptchaToggle.checked) {
                recaptchaFields.style.display = 'block';
            } else {
                recaptchaFields.style.display = 'none';
            }

            if (googleToggle.checked) {
                googleFields.style.display = 'block';
            } else {
                googleFields.style.display = 'none';
            }
        }
        
        // Inicializar a visibilidade
        updateFieldsVisibility();
        
        // Adicionar event listeners
        facebookPixelToggle.addEventListener('change', updateFieldsVisibility);
        recaptchaToggle.addEventListener('change', updateFieldsVisibility);

        googleToggle.addEventListener('change', updateFieldsVisibility);
        
        // Teste de conexão SMTP
        document.getElementById('test-smtp').addEventListener('click', function() {
            const button = this;
            const resultDiv = document.getElementById('smtp-test-result');
            
            button.disabled = true;
            button.textContent = 'Testando...';
            resultDiv.classList.add('hidden');
            
            // Coletar dados do formulário
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('host', document.getElementById('smtp_host').value);
            formData.append('port', document.getElementById('smtp_port').value);
            formData.append('username', document.getElementById('smtp_username').value);
            formData.append('password', document.getElementById('smtp_password').value);
            formData.append('encryption', document.getElementById('smtp_encryption').value);
            
            fetch('{{ route('admin.config.test-smtp') }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                resultDiv.classList.remove('hidden');
                if (data.success) {
                    resultDiv.className = 'mt-2 p-3 bg-green-100 text-green-800 rounded-md';
                    resultDiv.innerHTML = '✅ ' + data.message;
                } else {
                    resultDiv.className = 'mt-2 p-3 bg-red-100 text-red-800 rounded-md';
                    resultDiv.innerHTML = '❌ ' + data.message;
                }
            })
            .catch(error => {
                resultDiv.classList.remove('hidden');
                resultDiv.className = 'mt-2 p-3 bg-red-100 text-red-800 rounded-md';
                resultDiv.innerHTML = '❌ Erro ao testar conexão: ' + error;
            })
            .finally(() => {
                button.disabled = false;
                button.textContent = 'Testar Conexão SMTP';
            });
        });
    </script>
@endsection