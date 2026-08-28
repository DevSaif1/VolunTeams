<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>
    <head>
        <meta charset="utf-8">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >

        <meta
            name="csrf-token"
            content="{{ csrf_token() }}"
        >

        <title>{{ __('landing.nav.brand') }}</title>

        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])

        <style>
            /*
            |--------------------------------------------------------------------------
            | VolunTeams Animated Background
            |--------------------------------------------------------------------------
            */

            @keyframes volunteams-float-one {
                0%,
                100% {
                    transform: translate3d(-40px, -20px, 0) scale(1);
                    opacity: 0.55;
                }

                50% {
                    transform: translate3d(130px, 70px, 0) scale(1.18);
                    opacity: 0.78;
                }
            }

            @keyframes volunteams-float-two {
                0%,
                100% {
                    transform: translate3d(60px, 40px, 0) scale(1);
                    opacity: 0.45;
                }

                50% {
                    transform: translate3d(-120px, -85px, 0) scale(1.17);
                    opacity: 0.72;
                }
            }

            @keyframes volunteams-float-three {
                0%,
                100% {
                    transform: translate3d(-30px, 50px, 0) scale(1);
                    opacity: 0.38;
                }

                50% {
                    transform: translate3d(100px, -75px, 0) scale(1.2);
                    opacity: 0.65;
                }
            }

            .volunteams-bg-one {
                animation:
                    volunteams-float-one
                    11s
                    ease-in-out
                    infinite;
                will-change: transform, opacity;
            }

            .volunteams-bg-two {
                animation:
                    volunteams-float-two
                    14s
                    ease-in-out
                    infinite;
                will-change: transform, opacity;
            }

            .volunteams-bg-three {
                animation:
                    volunteams-float-three
                    12s
                    ease-in-out
                    infinite;
                will-change: transform, opacity;
            }

            /*
            |--------------------------------------------------------------------------
            | Decorative Outline Circles
            |--------------------------------------------------------------------------
            */

            @keyframes volunteams-circle-one {
                0%,
                100% {
                    transform: translate3d(0, 0, 0) scale(1);
                    opacity: 0.35;
                }

                50% {
                    transform: translate3d(-35px, 25px, 0) scale(1.08);
                    opacity: 0.55;
                }
            }

            @keyframes volunteams-circle-two {
                0%,
                100% {
                    transform: translate3d(0, 0, 0) scale(1);
                    opacity: 0.3;
                }

                50% {
                    transform: translate3d(30px, -25px, 0) scale(1.06);
                    opacity: 0.5;
                }
            }

            .volunteams-circle-one {
                animation:
                    volunteams-circle-one
                    15s
                    ease-in-out
                    infinite;
            }

            .volunteams-circle-two {
                animation:
                    volunteams-circle-two
                    17s
                    ease-in-out
                    infinite;
            }

            /*
            |--------------------------------------------------------------------------
            | Accessibility
            |--------------------------------------------------------------------------
            */

            @media (prefers-reduced-motion: reduce) {
                .volunteams-bg-one,
                .volunteams-bg-two,
                .volunteams-bg-three,
                .volunteams-circle-one,
                .volunteams-circle-two {
                    animation: none;
                }
            }
        </style>
    </head>

    <body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">

        <div class="relative min-h-screen overflow-hidden">

            {{-- Animated Background --}}
            <div
                class="pointer-events-none absolute inset-0 overflow-hidden"
                aria-hidden="true"
            >

                {{-- Soft base gradient --}}
                <div
                    class="absolute inset-0 bg-gradient-to-br from-slate-50 via-white to-slate-50"
                ></div>

                {{-- Indigo animated glow --}}
                <div
                    class="volunteams-bg-one absolute -top-48 start-[5%] h-[38rem] w-[38rem] rounded-full bg-indigo-300/40 blur-3xl"
                ></div>

                {{-- Emerald animated glow --}}
                <div
                    class="volunteams-bg-two absolute -bottom-48 end-[0%] h-[40rem] w-[40rem] rounded-full bg-emerald-300/35 blur-3xl"
                ></div>

                {{-- Blue animated glow --}}
                <div
                    class="volunteams-bg-three absolute top-[30%] start-[42%] h-[30rem] w-[30rem] rounded-full bg-blue-300/30 blur-3xl"
                ></div>

                {{-- Animated outline circle --}}
                <div
                    class="volunteams-circle-one absolute -top-24 end-[20%] h-72 w-72 rounded-full border border-indigo-300/30"
                ></div>

                {{-- Animated outline circle --}}
                <div
                    class="volunteams-circle-two absolute -bottom-20 start-[15%] h-64 w-64 rounded-full border border-emerald-300/30"
                ></div>

            </div>

            {{-- Top Navigation --}}
            <header
                class="relative z-10 border-b border-slate-200/70 bg-white/80 backdrop-blur-md"
            >
                <div
                    class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8"
                >

                    {{-- Brand --}}
                    <a
                        href="{{ url('/') }}"
                        class="flex items-center gap-3 transition-opacity duration-200 hover:opacity-80"
                    >
                        <span class="text-lg font-bold tracking-tight text-slate-900">
                            {{ __('landing.nav.brand') }}
                        </span>
                    </a>

                    {{-- Language Switcher --}}
                    @php
                        $currentLocale = app()->getLocale();

                        $targetLocale = $currentLocale === 'ar'
                            ? 'en'
                            : 'ar';

                        $targetLanguageLabel = $currentLocale === 'ar'
                            ? 'English'
                            : 'العربية';
                    @endphp

                    <a
                        href="{{ route('language.switch', ['locale' => $targetLocale]) }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-indigo-200 hover:text-indigo-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <span
                            class="text-slate-400"
                            aria-hidden="true"
                        >
                            ⇄
                        </span>

                        <span>
                            {{ $targetLanguageLabel }}
                        </span>
                    </a>

                </div>
            </header>

            {{-- Main Authentication Area --}}
            <main
                class="relative z-10 flex min-h-[calc(100vh-4rem)] items-center justify-center px-4 py-10 sm:px-6 lg:px-8"
            >

                <div class="w-full max-w-5xl">

                    {{-- Authentication Grid --}}
                    <div
                        class="grid overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50 lg:grid-cols-2"
                    >

                        {{-- Brand / Welcome Panel --}}
                        <div
                            class="relative hidden overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-600 to-emerald-500 p-10 text-white lg:flex lg:flex-col lg:justify-between"
                        >

                            {{-- Decorative circles --}}
                            <div
                                class="absolute -top-20 -end-20 h-64 w-64 rounded-full bg-white/10"
                                aria-hidden="true"
                            ></div>

                            <div
                                class="absolute -bottom-24 -start-20 h-72 w-72 rounded-full bg-emerald-300/10"
                                aria-hidden="true"
                            ></div>

                            <div class="relative">

                                <div
                                    class="mb-8 inline-flex rounded-2xl bg-white/10 p-4 ring-1 ring-white/20"
                                >
                                    <x-application-logo class="h-24 w-24" />
                                </div>

                                <p
                                    class="mb-3 text-sm font-semibold uppercase tracking-[0.2em] text-white/70"
                                >
                                    VolunTeams
                                </p>

                                <h1 class="max-w-md text-3xl font-bold leading-tight">
                                    {{ app()->getLocale() === 'ar'
                                        ? 'منصة ذكية لإدارة الفرق والفرص التطوعية'
                                        : 'Smart management for volunteer teams and opportunities'
                                    }}
                                </h1>

                                <p class="mt-5 max-w-md text-sm leading-7 text-white/80">
                                    {{ app()->getLocale() === 'ar'
                                        ? 'نظّم الفرق، أدر الفرص، تابع الطلبات وساعات التطوع، واحتفظ بشهاداتك في مكان واحد.'
                                        : 'Manage teams, opportunities, applications, volunteer hours, and certificates in one place.'
                                    }}
                                </p>

                            </div>

                            <div class="relative mt-10">

                                <div
                                    class="flex items-center gap-3 text-sm text-white/80"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-emerald-300"
                                    ></span>

                                    <span>
                                        {{ app()->getLocale() === 'ar'
                                            ? 'نظام إدارة تطوعي متكامل'
                                            : 'Complete volunteer management platform'
                                        }}
                                    </span>
                                </div>

                            </div>

                        </div>

                        {{-- Authentication Form --}}
                        <div
                            class="flex items-center bg-white p-6 sm:p-10 lg:p-12"
                        >

                            <div class="mx-auto w-full max-w-md">

                                {{-- Mobile Logo --}}
                                <div class="mb-8 flex justify-center lg:hidden">
                                    <a href="{{ url('/') }}">
                                        <x-application-logo class="h-24 w-24" />
                                    </a>
                                </div>

                                {{-- Form Content --}}
                                {{ $slot }}

                            </div>

                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="mt-6 text-center text-xs text-slate-400">
                        © {{ date('Y') }} {{ __('landing.nav.brand') }}.
                    </div>

                </div>

            </main>

        </div>

    </body>
</html>