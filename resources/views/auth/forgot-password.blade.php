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
                {{ __('Esqueceu a sua senha?') }}
            </h2>

            <!-- Descrição -->
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('Sem problemas. Basta nos informar o seu endereço de e-mail e enviaremos um link para redefinir a senha, que permitirá que você escolha uma nova.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="w-full justify-center py-3 text-lg rounded-xl">
                        {{ __('Enviar link para redefinir a senha') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Divider opcional (caso queira colocar outro método ou link) -->
            {{-- 
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
                <span class="mx-2 text-sm text-gray-500 dark:text-gray-400">or</span>
                <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
            </div> 
            --}}
        </div>
    </div>
</x-guest-layout>
