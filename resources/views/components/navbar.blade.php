@php
    $currentLocale = app()->getLocale();

    $targetLocale = $currentLocale === 'ar' ? 'en' : 'ar';

    $targetLanguageLabel = $currentLocale === 'ar'
        ? 'English'
        : 'العربية';
@endphp

<nav
    class="sticky top-0 z-50
           bg-white/95 backdrop-blur-xl
           border-b border-slate-200
           shadow-sm"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-[72px]">

            {{-- =====================================================
                 BRAND
            ====================================================== --}}
            <div class="flex-shrink-0">

                <a
                    href="{{ url('/') }}"
                    class="group inline-flex items-center gap-3"
                    aria-label="{{ __('landing.nav.brand') }}"
                >

                    {{-- Logo --}}
                    <div
                        class="w-10 h-10 sm:w-11 sm:h-11
                               rounded-xl
                               bg-white
                               border border-slate-200
                               flex items-center justify-center
                               overflow-hidden
                               shadow-sm
                               group-hover:shadow-md
                               group-hover:border-emerald-200
                               transition-all duration-200"
                    >
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="{{ __('landing.nav.brand') }}"
                            class="w-9 h-9 sm:w-10 sm:h-10 object-contain"
                        >
                    </div>


                    {{-- Brand Name --}}
                    <span
                        class="text-lg sm:text-xl
                               font-extrabold
                               tracking-tight
                               text-slate-900
                               group-hover:text-emerald-600
                               transition-colors duration-200"
                    >
                        {{ __('landing.nav.brand') }}
                    </span>

                </a>

            </div>


            {{-- =====================================================
                 DESKTOP NAVIGATION
            ====================================================== --}}
            <div class="hidden lg:flex items-center gap-7">

                <a
                    href="#hero"
                    class="text-sm font-semibold
                           text-slate-600
                           hover:text-emerald-600
                           transition-colors duration-200"
                >
                    {{ __('landing.nav.home') }}
                </a>


                <a
                    href="#features"
                    class="text-sm font-semibold
                           text-slate-600
                           hover:text-emerald-600
                           transition-colors duration-200"
                >
                    {{ __('landing.nav.features') }}
                </a>


                <a
                    href="#roles"
                    class="text-sm font-semibold
                           text-slate-600
                           hover:text-emerald-600
                           transition-colors duration-200"
                >
                    {{ __('landing.nav.roles') }}
                </a>


                <a
                    href="#tech"
                    class="text-sm font-semibold
                           text-slate-600
                           hover:text-emerald-600
                           transition-colors duration-200"
                >
                    {{ __('landing.nav.tech') }}
                </a>


                <a
                    href="#footer"
                    class="text-sm font-semibold
                           text-slate-600
                           hover:text-emerald-600
                           transition-colors duration-200"
                >
                    {{ __('landing.nav.about') }}
                </a>

            </div>


            {{-- =====================================================
                 DESKTOP ACTIONS
            ====================================================== --}}
            <div class="hidden lg:flex items-center gap-2.5">

                {{-- Language Switcher --}}
                <a
                    href="{{ route('language.switch', $targetLocale) }}"
                    class="inline-flex items-center gap-2
                           px-3.5 py-2
                           rounded-lg
                           border border-slate-200
                           bg-slate-50
                           text-slate-700
                           text-xs font-bold
                           hover:bg-emerald-50
                           hover:border-emerald-200
                           hover:text-emerald-700
                           transition-all duration-200"
                    aria-label="{{ $targetLanguageLabel }}"
                >

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 5h12M9 3v2m1 4h6m-1 0l-4 10M5 19l6-10"
                        />
                    </svg>

                    <span>
                        {{ $targetLanguageLabel }}
                    </span>

                </a>


                @auth

                    {{-- Dashboard --}}
                    <x-button
                        href="{{ route('dashboard') }}"
                        variant="primary"
                        class="bg-emerald-600
                               hover:bg-emerald-700
                               focus:ring-emerald-500
                               shadow-sm"
                    >
                        {{ __('landing.nav.dashboard') }}

                        <span class="ms-1.5">→</span>
                    </x-button>

                @else

                    {{-- Login --}}
                    <x-button
                        href="{{ route('login') }}"
                        variant="ghost"
                        class="text-slate-600
                               hover:text-emerald-700
                               hover:bg-emerald-50
                               focus:ring-emerald-400"
                    >
                        {{ __('landing.nav.login') }}
                    </x-button>


                    {{-- Register --}}
                    <x-button
                        href="{{ route('register') }}"
                        variant="primary"
                        class="bg-emerald-600
                               hover:bg-emerald-700
                               focus:ring-emerald-500
                               shadow-sm"
                    >
                        {{ __('landing.nav.register') }}

                        <span class="ms-1.5">→</span>
                    </x-button>

                @endauth

            </div>


            {{-- =====================================================
                 MOBILE MENU BUTTON
            ====================================================== --}}
            <div
                class="lg:hidden"
                x-data="{ open: false }"
            >

                <button
                    type="button"
                    @click="open = !open"
                    class="inline-flex items-center justify-center
                           w-10 h-10
                           rounded-lg
                           border border-slate-200
                           bg-white
                           text-slate-600
                           hover:bg-emerald-50
                           hover:text-emerald-600
                           hover:border-emerald-200
                           focus:outline-none
                           focus:ring-2
                           focus:ring-emerald-500
                           transition-all duration-200"
                    :aria-expanded="open"
                    aria-label="Toggle navigation"
                >

                    {{-- Menu Icon --}}
                    <svg
                        x-show="!open"
                        x-cloak
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>


                    {{-- Close Icon --}}
                    <svg
                        x-show="open"
                        x-cloak
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>


                {{-- =================================================
                     MOBILE DROPDOWN
                ================================================== --}}
                <div
                    x-show="open"
                    x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="absolute inset-x-0 top-[72px]
                           bg-white
                           border-b border-slate-200
                           shadow-lg"
                >

                    <div class="max-w-7xl mx-auto px-4 py-5">

                        {{-- Mobile Navigation --}}
                        <div class="flex flex-col gap-1">

                            <a
                                href="#hero"
                                @click="open = false"
                                class="px-4 py-3
                                       rounded-lg
                                       text-sm font-semibold
                                       text-slate-700
                                       hover:bg-emerald-50
                                       hover:text-emerald-700
                                       transition-colors"
                            >
                                {{ __('landing.nav.home') }}
                            </a>


                            <a
                                href="#features"
                                @click="open = false"
                                class="px-4 py-3
                                       rounded-lg
                                       text-sm font-semibold
                                       text-slate-700
                                       hover:bg-emerald-50
                                       hover:text-emerald-700
                                       transition-colors"
                            >
                                {{ __('landing.nav.features') }}
                            </a>


                            <a
                                href="#roles"
                                @click="open = false"
                                class="px-4 py-3
                                       rounded-lg
                                       text-sm font-semibold
                                       text-slate-700
                                       hover:bg-emerald-50
                                       hover:text-emerald-700
                                       transition-colors"
                            >
                                {{ __('landing.nav.roles') }}
                            </a>


                            <a
                                href="#tech"
                                @click="open = false"
                                class="px-4 py-3
                                       rounded-lg
                                       text-sm font-semibold
                                       text-slate-700
                                       hover:bg-emerald-50
                                       hover:text-emerald-700
                                       transition-colors"
                            >
                                {{ __('landing.nav.tech') }}
                            </a>


                            <a
                                href="#footer"
                                @click="open = false"
                                class="px-4 py-3
                                       rounded-lg
                                       text-sm font-semibold
                                       text-slate-700
                                       hover:bg-emerald-50
                                       hover:text-emerald-700
                                       transition-colors"
                            >
                                {{ __('landing.nav.about') }}
                            </a>

                        </div>


                        {{-- Divider --}}
                        <div class="my-4 border-t border-slate-200"></div>


                        {{-- Mobile Actions --}}
                        <div class="flex flex-col gap-2.5">

                            {{-- Language --}}
                            <a
                                href="{{ route('language.switch', $targetLocale) }}"
                                class="inline-flex items-center justify-center
                                       gap-2
                                       w-full
                                       px-4 py-3
                                       rounded-lg
                                       border border-slate-200
                                       bg-slate-50
                                       text-sm font-semibold
                                       text-slate-700
                                       hover:bg-emerald-50
                                       hover:border-emerald-200
                                       hover:text-emerald-700
                                       transition-all"
                            >

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 5h12M9 3v2m1 4h6m-1 0l-4 10M5 19l6-10"
                                    />
                                </svg>

                                {{ $targetLanguageLabel }}

                            </a>


                            @auth

                                <x-button
                                    href="{{ route('dashboard') }}"
                                    variant="primary"
                                    class="w-full
                                           bg-emerald-600
                                           hover:bg-emerald-700
                                           focus:ring-emerald-500"
                                >
                                    {{ __('landing.nav.dashboard') }}

                                    <span class="ms-1.5">→</span>
                                </x-button>

                            @else

                                <x-button
                                    href="{{ route('login') }}"
                                    variant="ghost"
                                    class="w-full
                                           text-slate-700
                                           hover:text-emerald-700
                                           hover:bg-emerald-50
                                           focus:ring-emerald-400"
                                >
                                    {{ __('landing.nav.login') }}
                                </x-button>


                                <x-button
                                    href="{{ route('register') }}"
                                    variant="primary"
                                    class="w-full
                                           bg-emerald-600
                                           hover:bg-emerald-700
                                           focus:ring-emerald-500"
                                >
                                    {{ __('landing.nav.register') }}

                                    <span class="ms-1.5">→</span>
                                </x-button>

                            @endauth

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</nav>