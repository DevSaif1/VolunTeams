<x-guest-layout>

    {{-- Page Header --}}
    <div class="text-center">

        {{-- Security Icon --}}
        <div
            class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl
                   bg-indigo-50 text-indigo-600
                   ring-1 ring-indigo-100
                   shadow-sm"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2-2z"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8 10V7a4 4 0 1 1 8 0v3"
                />
            </svg>
        </div>

        {{-- Title --}}
        <h1
            class="mt-6 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl"
        >
            {{ app()->getLocale() === 'ar'
                ? 'تأكيد كلمة المرور'
                : 'Confirm your password'
            }}
        </h1>

        {{-- Description --}}
        <p
            class="mx-auto mt-3 max-w-md text-sm leading-7 text-slate-500"
        >
            {{ app()->getLocale() === 'ar'
                ? 'هذه منطقة آمنة من التطبيق. يرجى تأكيد كلمة المرور الخاصة بك قبل المتابعة.'
                : 'This is a secure area of the application. Please confirm your password before continuing.'
            }}
        </p>

    </div>


    {{-- Error Message --}}
    @if ($errors->any())

        <div
            class="mt-6 rounded-2xl border border-red-100 bg-red-50 px-4 py-3.5
                   text-sm leading-6 text-red-700 shadow-sm"
            role="alert"
        >
            <div class="flex items-start gap-3">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0z"
                    />
                </svg>

                <span>
                    {{ $errors->first() }}
                </span>

            </div>
        </div>

    @endif


    {{-- Confirm Password Form --}}
    <form
        method="POST"
        action="{{ route('password.confirm') }}"
        class="mt-8"
    >

        @csrf


        {{-- Password Field --}}
        <div>

            <x-input-label
                for="password"
                :value="app()->getLocale() === 'ar'
                    ? 'كلمة المرور الحالية'
                    : 'Current Password'"
                class="font-medium text-slate-700"
            />

            <div class="relative mt-2">

                <x-text-input
                    id="password"
                    class="block w-full rounded-xl border-slate-200 bg-white
                           px-4 py-3.5 text-slate-900 shadow-sm
                           transition-all duration-200
                           placeholder:text-slate-400
                           hover:border-slate-300
                           focus:border-indigo-500
                           focus:ring-4 focus:ring-indigo-500/10"
                    type="password"
                    name="password"
                    required
                    autofocus
                    autocomplete="current-password"
                    placeholder="{{ app()->getLocale() === 'ar'
                        ? 'أدخل كلمة المرور الحالية'
                        : 'Enter your current password'
                    }}"
                />

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- Confirm Button --}}
        <div class="mt-6">

            <button
                type="submit"
                class="group inline-flex w-full items-center justify-center gap-2
                       rounded-xl bg-indigo-600 px-6 py-3.5
                       text-sm font-semibold text-white
                       shadow-md shadow-indigo-200
                       transition-all duration-200
                       hover:-translate-y-0.5
                       hover:bg-indigo-700
                       hover:shadow-lg hover:shadow-indigo-200
                       focus:outline-none
                       focus:ring-2 focus:ring-indigo-500
                       focus:ring-offset-2
                       active:translate-y-0"
            >

                <span>
                    {{ app()->getLocale() === 'ar'
                        ? 'تأكيد والمتابعة'
                        : 'Confirm & Continue'
                    }}
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-200
                           group-hover:translate-x-0.5 rtl:rotate-180 rtl:group-hover:-translate-x-0.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14m-6-6 6 6-6 6"
                    />
                </svg>

            </button>

        </div>


        {{-- Security Information --}}
        <div
            class="mt-6 rounded-2xl border border-slate-100
                   bg-slate-50/80 px-4 py-4
                   shadow-sm"
        >

            <div class="flex items-start gap-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                           rounded-xl bg-white text-emerald-500
                           ring-1 ring-slate-100"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4.5 w-4.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3.5 19 7v5c0 4.5-3 7.5-7 8.5-4-1-7-4-7-8.5V7l7-3.5z"
                        />
                    </svg>
                </div>

                <div>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ app()->getLocale() === 'ar'
                            ? 'حماية إضافية للحساب'
                            : 'Additional account security'
                        }}
                    </p>

                    <p class="mt-1 text-xs leading-5 text-slate-500">
                        {{ app()->getLocale() === 'ar'
                            ? 'لأسباب أمنية، نحتاج إلى تأكيد كلمة المرور قبل السماح بالوصول إلى هذه المنطقة.'
                            : 'For security reasons, your password must be confirmed before accessing this area.'
                        }}
                    </p>

                </div>

            </div>

        </div>

    </form>

</x-guest-layout>