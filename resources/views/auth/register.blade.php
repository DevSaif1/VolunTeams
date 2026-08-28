<x-guest-layout>
    <!-- Page Heading & Subtitle -->
    <div class="mb-8 text-center sm:text-start">
        <h2 class="text-2xl font-bold text-slate-900">{{ __('auth.register.title') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('auth.register.subtitle') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('auth.register.name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('auth.register.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('auth.register.password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('auth.register.confirm_password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6">
            <a class="text-sm text-indigo-600 hover:text-indigo-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('auth.register.already_registered') }}
            </a>

            <x-primary-button class="w-full sm:w-auto justify-center">
                {{ __('auth.register.submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>