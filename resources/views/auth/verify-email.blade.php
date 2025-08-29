<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-8">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="{{ url('/') }}">
                    <x-application-logo class="w-16 h-16 text-indigo-600 dark:text-indigo-400" />
                </a>
            </div>

            <!-- Título -->
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">
                {{ __('Verifique seu Email 📩') }}
            </h2>

            <!-- Mensagem -->
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('Obrigado por se registrar! Antes de começar, confirme seu endereço de email clicando no link que acabamos de enviar. 
                Caso não tenha recebido, podemos reenviar outro para você.') }}
            </div>

            <!-- Status -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center">
                    {{ __('Um novo link de verificação foi enviado para o email que você forneceu no registro.') }}
                </div>
            @endif

            <!-- Botões -->
            <div class="mt-6 flex flex-col gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="w-full justify-center py-3 text-lg rounded-xl">
                        {{ __('Reenviar Email de Verificação') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full py-3 text-lg rounded-xl text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 
                               hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        {{ __('Sair') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
