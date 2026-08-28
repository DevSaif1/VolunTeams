<x-guest-layout>

    <div class="mb-8 text-center">

        {{-- Icon --}}
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
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2z"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8 10V7a4 4 0 118 0v3"
                />
            </svg>

        </div>


        {{-- Title --}}
        <h2 class="text-2xl font-bold tracking-tight text-slate-900">

            {{ app()->getLocale() === 'ar'
                ? 'إنشاء كلمة مرور جديدة'
                : 'Create a new password'
            }}

        </h2>


        {{-- Description --}}
        <p class="mt-3 text-sm leading-6 text-slate-500">

            {{ app()->getLocale() === 'ar'
                ? 'أنشئ كلمة مرور جديدة وآمنة لحسابك.'
                : 'Create a new secure password for your account.'
            }}

        </p>

    </div>


    {{-- Errors --}}
    @if ($errors->any())

        <div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">

            {{ $errors->first() }}

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('password.otp.update') }}"
    >

        @csrf


        {{-- New Password --}}
        <div>

            <x-input-label
                for="password"
                :value="app()->getLocale() === 'ar'
                    ? 'كلمة المرور الجديدة'
                    : 'New Password'"
            />

            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-xl"
                type="password"
                name="password"
                required
                autofocus
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- Confirm Password --}}
        <div class="mt-5">

            <x-input-label
                for="password_confirmation"
                :value="app()->getLocale() === 'ar'
                    ? 'تأكيد كلمة المرور'
                    : 'Confirm Password'"
            />

            <x-text-input
                id="password_confirmation"
                class="mt-2 block w-full rounded-xl"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>


        {{-- Password requirements --}}
        <div class="mt-5 rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">

            <p class="text-xs font-medium text-slate-500">

                {{ app()->getLocale() === 'ar'
                    ? 'يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل.'
                    : 'Password must contain at least 8 characters.'
                }}

            </p>

        </div>


        {{-- Submit --}}
        <div class="mt-6">

            <button
                type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >

                <span>

                    {{ app()->getLocale() === 'ar'
                        ? 'تحديث كلمة المرور'
                        : 'Update Password'
                    }}

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


        {{-- Back --}}
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