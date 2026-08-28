<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Page Heading & Subtitle -->
    <div class="mb-8 text-center sm:text-start">
        <h2 class="text-2xl font-bold text-slate-900">{{ __('auth.login.title') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('auth.login.subtitle') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('auth.login.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('auth.login.password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('auth.login.remember') }}</span>
            </label>
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('auth.login.forgot_password') }}
                </a>
            @endif

            <x-primary-button class="w-full sm:w-auto justify-center">
                {{ __('auth.login.submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>