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
                {{ __('Bem vindo de volta 👋') }}
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="email" 
                        class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autofocus 
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="password" 
                        class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500" 
                        type="password" 
                        name="password" 
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" 
                            class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-800" 
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline" 
                            href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <x-primary-button class="w-full justify-center py-3 text-lg rounded-xl">
                    {{ __('Sign In') }}
                </x-primary-button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
                <span class="mx-2 text-sm text-gray-500 dark:text-gray-400">or</span>
                <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
            </div>

            
        </div>
    </div>
</x-guest-layout>
