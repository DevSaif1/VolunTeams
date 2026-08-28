<x-guest-layout>

    {{-- Header --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-7 w-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 7a3 3 0 10-6 0v2m-1 0h8a2 2 0 012 2v7a2 2 0 01-2 2H8a2 2 0 01-2-2v-7a2 2 0 012-2z"
                />
            </svg>
        </div>

        <h2 class="text-2xl font-bold tracking-tight text-slate-900">
            {{ __('auth.forgot_password.title') }}
        </h2>

        <p class="mt-3 text-sm leading-6 text-slate-500">
            {{ __('auth.forgot_password.description') }}
        </p>

    </div>


    {{-- Status Message --}}
    <x-auth-session-status
        class="mb-5"
        :status="session('status')"
    />


    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif


    {{-- Forgot Password Form --}}
    <form method="POST" action="{{ route('password.otp.send') }}">
        @csrf

        {{-- Email --}}
        <div>

            <x-input-label
                for="email"
                :value="__('auth.forgot_password.email')"
            />

            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-xl border-slate-200 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="email"
                placeholder="name@example.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- Submit --}}
        <div class="mt-6">

            <button
                type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >

                <span>
                    {{ __('auth.forgot_password.submit') }}
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 rtl:rotate-180"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14m-6-6l6 6-6 6"
                    />
                </svg>

            </button>

        </div>


        {{-- Back to Login --}}
        <div class="mt-6 text-center">

            <a
                href="{{ route('login') }}"
                class="text-sm font-medium text-slate-500 transition hover:text-indigo-600"
            >
                {{ app()->getLocale() === 'ar'
                    ? 'العودة إلى تسجيل الدخول'
                    : 'Back to Login'
                }}
            </a>

        </div>

    </form>

</x-guest-layout>