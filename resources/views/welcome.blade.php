<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ __('landing.nav.brand') }} - {{ __('landing.hero.badge') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    {{-- =========================================================
         NAVBAR
    ========================================================== --}}
    <x-navbar />

    <main>

        {{-- =========================================================
             HERO
        ========================================================== --}}
        <section
            id="hero"
            class="relative overflow-hidden bg-white border-b border-slate-200"
        >

            {{-- Soft Background Decorations --}}
            <div class="absolute inset-0 pointer-events-none overflow-hidden">

                <div
                    class="absolute -top-40 -end-40 w-[28rem] h-[28rem]
                           rounded-full bg-emerald-100/60 blur-3xl"
                ></div>

                <div
                    class="absolute -bottom-40 -start-40 w-[28rem] h-[28rem]
                           rounded-full bg-emerald-50/80 blur-3xl"
                ></div>

                <div
                    class="absolute top-1/2 start-1/2
                           -translate-x-1/2 -translate-y-1/2
                           w-96 h-96 rounded-full
                           bg-emerald-50/50 blur-3xl"
                ></div>

            </div>


            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div
                    class="grid grid-cols-1 lg:grid-cols-12
                           gap-12 lg:gap-20 items-center
                           py-16 sm:py-20 lg:py-24"
                >

                    {{-- =================================================
                         HERO CONTENT
                    ================================================== --}}
                    <div class="lg:col-span-7 text-center lg:text-start">

                        {{-- Badge --}}
                        <span
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-full
                                   bg-emerald-50
                                   text-emerald-700
                                   border border-emerald-100
                                   text-xs sm:text-sm font-bold"
                        >
                            <span
                                class="w-2 h-2 rounded-full bg-emerald-600"
                            ></span>

                            {{ __('landing.hero.badge') }}
                        </span>


                        {{-- Title --}}
                        <h1
                            class="mt-6 text-4xl sm:text-5xl lg:text-6xl
                                   font-extrabold tracking-tight
                                   text-slate-950
                                   leading-[1.08]"
                        >
                            {{ __('landing.hero.title') }}
                        </h1>


                        {{-- Description --}}
                        <p
                            class="mt-6 max-w-2xl mx-auto lg:mx-0
                                   text-base sm:text-lg lg:text-xl
                                   text-slate-600
                                   leading-relaxed"
                        >
                            {{ __('landing.hero.description') }}
                        </p>


                        {{-- Hero Actions --}}
                        <div
                            class="mt-8 flex flex-col sm:flex-row
                                   items-center justify-center
                                   lg:justify-start gap-3"
                        >

                            @auth

                                <x-button
                                    href="{{ route('dashboard') }}"
                                    variant="primary"
                                    class="w-full sm:w-auto px-7 py-3"
                                >
                                    {{ __('landing.nav.dashboard') }}

                                    <span class="ms-2">→</span>
                                </x-button>

                            @else

                                <x-button
                                    href="{{ route('register') }}"
                                    variant="primary"
                                    class="w-full sm:w-auto px-7 py-3"
                                >
                                    {{ __('landing.hero.start_now') }}

                                    <span class="ms-2">→</span>
                                </x-button>


                                <x-button
                                    href="{{ route('login') }}"
                                    variant="secondary"
                                    class="w-full sm:w-auto px-7 py-3"
                                >
                                    {{ __('landing.hero.login_account') }}
                                </x-button>

                            @endauth

                        </div>

                    </div>


                    {{-- =================================================
                         HERO LOGO CARD
                    ================================================== --}}
                    <div class="lg:col-span-5">

                        <div class="relative mx-auto max-w-md">

                            {{-- Glow --}}
                            <div
                                class="absolute inset-8 rounded-full
                                       bg-emerald-200/50 blur-3xl"
                            ></div>


                            <div
                                class="relative rounded-[2rem]
                                       border border-slate-200
                                       bg-white p-5 sm:p-7
                                       shadow-xl shadow-slate-200/60"
                            >

                                {{-- Logo Area --}}
                                <div
                                    class="relative aspect-square
                                           rounded-2xl
                                           bg-gradient-to-br
                                           from-emerald-50
                                           via-white
                                           to-slate-50
                                           border border-slate-100
                                           flex items-center
                                           justify-center
                                           overflow-hidden"
                                >

                                    <div
                                        class="absolute inset-8
                                               rounded-full
                                               bg-emerald-100/50
                                               blur-2xl"
                                    ></div>


                                    <img
                                        src="{{ asset('images/logo.png') }}"
                                        alt="{{ __('landing.nav.brand') }}"
                                        class="relative w-[78%] h-[78%]
                                               object-contain
                                               drop-shadow-md"
                                    >

                                </div>


                                {{-- Card Information --}}
                                <div class="mt-6">

                                    <div
                                        class="flex flex-col sm:flex-row
                                               items-start sm:items-center
                                               justify-between gap-4"
                                    >

                                        <div>

                                            <p
                                                class="text-xs font-semibold
                                                       uppercase
                                                       tracking-[0.15em]
                                                       text-slate-500"
                                            >
                                                {{ __('landing.nav.brand') }}
                                            </p>

                                            <p
                                                class="mt-1 text-lg font-bold
                                                       text-slate-900"
                                            >
                                                {{ __('landing.hero.badge') }}
                                            </p>

                                        </div>


                                        {{-- Live Status --}}
                                        <span
                                            class="inline-flex items-center gap-2
                                                   rounded-full
                                                   bg-emerald-50
                                                   border border-emerald-100
                                                   px-3.5 py-1.5
                                                   text-xs font-bold
                                                   text-emerald-700"
                                        >
                                            <span
                                                class="w-2 h-2 rounded-full
                                                       bg-emerald-500"
                                            ></span>

                                            {{ __('landing.hero.live') }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     HERO STATISTICS
                ====================================================== --}}
                <div
                    class="border-t border-slate-100
                           py-10 sm:py-12
                           grid grid-cols-2 md:grid-cols-4
                           gap-4 sm:gap-6"
                >

                    @foreach ([
                        ['value' => '500+', 'label' => __('landing.hero.stats.volunteers')],
                        ['value' => '35+',  'label' => __('landing.hero.stats.teams')],
                        ['value' => '120+', 'label' => __('landing.hero.stats.opportunities')],
                        ['value' => '850+', 'label' => __('landing.hero.stats.certificates')],
                    ] as $stat)

                        <div
                            class="text-center rounded-2xl
                                   border border-slate-200
                                   bg-white px-4 py-5
                                   shadow-sm
                                   hover:shadow-md
                                   hover:-translate-y-0.5
                                   transition-all duration-200"
                        >
                            <div
                                class="text-2xl sm:text-3xl
                                       font-extrabold
                                       text-emerald-600"
                            >
                                {{ $stat['value'] }}
                            </div>

                            <div
                                class="mt-1 text-xs sm:text-sm
                                       font-medium text-slate-500"
                            >
                                {{ $stat['label'] }}
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- =========================================================
             FEATURES
        ========================================================== --}}
        <section
            id="features"
            class="py-16 md:py-24 bg-slate-50"
        >

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div
                    class="max-w-3xl mx-auto text-center mb-12"
                >

                    <span
                        class="text-xs font-bold uppercase
                               tracking-[0.2em]
                               text-emerald-600"
                    >
                        VolunTeams
                    </span>

                    <h2
                        class="mt-3 text-3xl sm:text-4xl
                               font-extrabold text-slate-950"
                    >
                        {{ __('landing.features.title') }}
                    </h2>

                    <p
                        class="mt-4 text-slate-600
                               leading-relaxed"
                    >
                        {{ __('landing.features.subtitle') }}
                    </p>

                </div>


                <div
                    class="grid grid-cols-1 md:grid-cols-2
                           lg:grid-cols-3 gap-6"
                >

                    @php
                        $features = [
                            __('landing.features.team_mgmt.title') => __('landing.features.team_mgmt.desc'),
                            __('landing.features.opportunities.title') => __('landing.features.opportunities.desc'),
                            __('landing.features.certificates.title') => __('landing.features.certificates.desc'),
                            __('landing.features.rbac.title') => __('landing.features.rbac.desc'),
                            __('landing.features.reports.title') => __('landing.features.reports.desc'),
                            __('landing.features.bilingual.title') => __('landing.features.bilingual.desc'),
                        ];
                    @endphp

                    @foreach ($features as $title => $description)

                        <x-card>
                            <div class="flex items-start gap-4">

                                <div
                                    class="flex-shrink-0 w-11 h-11
                                           rounded-xl
                                           bg-emerald-50
                                           text-emerald-600
                                           border border-emerald-100
                                           flex items-center
                                           justify-center
                                           font-bold"
                                >
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                <div>

                                    <h3
                                        class="text-lg font-bold
                                               text-slate-900"
                                    >
                                        {{ $title }}
                                    </h3>

                                    <p
                                        class="mt-2 text-sm
                                               text-slate-600
                                               leading-relaxed"
                                    >
                                        {{ $description }}
                                    </p>

                                </div>

                            </div>
                        </x-card>

                    @endforeach

                </div>

            </div>

        </section>

    {{-- =========================================================
     FEATURED VOLUNTEER OPPORTUNITIES
    ========================================================== --}}
<section
    id="opportunities"
    class="py-16 md:py-24 bg-white border-y border-slate-200"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="max-w-3xl mx-auto text-center mb-12">

            <span
                class="text-xs font-bold uppercase
                       tracking-[0.2em]
                       text-emerald-600"
            >
                {{ __('landing.featured_opportunities.eyebrow') }}
            </span>

            <h2
                class="mt-3 text-3xl sm:text-4xl
                       font-extrabold
                       text-slate-950"
            >
                {{ __('landing.featured_opportunities.title') }}
            </h2>

            <p
                class="mt-4 text-slate-600
                       leading-relaxed"
            >
                {{ __('landing.featured_opportunities.subtitle') }}
            </p>

        </div>


        {{-- Opportunities --}}
        @if ($featuredOpportunities->isNotEmpty())

            <div
                class="grid grid-cols-1
                       md:grid-cols-2
                       lg:grid-cols-3
                       gap-6"
            >

                @foreach ($featuredOpportunities as $opportunity)

                    <article
                        class="group bg-white
                               rounded-2xl
                               border border-slate-200
                               overflow-hidden
                               shadow-sm
                               hover:shadow-xl
                               hover:-translate-y-1
                               hover:border-emerald-200
                               transition-all duration-300"
                    >

                        {{-- Opportunity Image --}}
                        <div
                            class="relative h-52
                                   bg-gradient-to-br
                                   from-emerald-50
                                   via-white
                                   to-slate-100
                                   overflow-hidden"
                        >

                            @if ($opportunity->image_path)

                                <img
                                    src="{{ asset('storage/' . $opportunity->image_path) }}"
                                    alt="{{ $opportunity->title }}"
                                    class="w-full h-full
                                           object-cover
                                           group-hover:scale-105
                                           transition-transform
                                           duration-500"
                                >

                            @else

                                <div
                                    class="w-full h-full
                                           flex items-center
                                           justify-center"
                                >

                                    <div
                                        class="w-16 h-16
                                               rounded-2xl
                                               bg-emerald-100
                                               text-emerald-600
                                               flex items-center
                                               justify-center"
                                    >

                                        <svg
                                            class="w-8 h-8"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M12 21a9 9 0 100-18 9 9 0 000 18zm0-13v8m-4-4h8"
                                            />
                                        </svg>

                                    </div>

                                </div>

                            @endif


                            {{-- Opportunity Type --}}
                            <div
                                class="absolute top-4 start-4"
                            >
                                <span
                                    class="inline-flex items-center
                                           px-3 py-1.5
                                           rounded-full
                                           bg-white/95
                                           backdrop-blur-sm
                                           border border-white
                                           shadow-sm
                                           text-xs font-bold
                                           text-emerald-700"
                                >
                                    {{ $opportunity->type }}
                                </span>
                            </div>

                        </div>


                        {{-- Content --}}
                        <div class="p-6">

                            {{-- Title --}}
                            <h3
                                class="text-xl font-bold
                                       text-slate-900
                                       line-clamp-2"
                            >
                                {{ $opportunity->title }}
                            </h3>


                            {{-- Description --}}
                            <p
                                class="mt-3 text-sm
                                       text-slate-600
                                       leading-6
                                       line-clamp-3"
                            >
                                {{ $opportunity->description }}
                            </p>


                            {{-- Meta Information --}}
                            <div
                                class="mt-5 space-y-3"
                            >

                                {{-- Location --}}
                                <div
                                    class="flex items-center gap-2
                                           text-sm text-slate-600"
                                >

                                    <svg
                                        class="w-4 h-4
                                               flex-shrink-0
                                               text-emerald-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M12 21s7-5.2 7-12a7 7 0 10-14 0c0 6.8 7 12 7 12z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="9"
                                            r="2.2"
                                        />
                                    </svg>

                                    <span class="truncate">
                                        {{ $opportunity->location ?: __('landing.featured_opportunities.no_location') }}
                                    </span>

                                </div>


                                {{-- Hours --}}
                                <div
                                    class="flex items-center gap-2
                                           text-sm text-slate-600"
                                >

                                    <svg
                                        class="w-4 h-4
                                               flex-shrink-0
                                               text-emerald-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M12 7v5l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>

                                    <span>
                                        {{ $opportunity->hours }}
                                        {{ __('landing.featured_opportunities.hours') }}
                                    </span>

                                </div>


                                {{-- Volunteers --}}
                                <div
                                    class="flex items-center gap-2
                                           text-sm text-slate-600"
                                >

                                    <svg
                                        class="w-4 h-4
                                               flex-shrink-0
                                               text-emerald-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m8-8a4 4 0 100-8 4 4 0 000 8zm8 8v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                        />
                                    </svg>

                                    <span>
                                        {{ $opportunity->required_volunteers }}
                                        {{ __('landing.featured_opportunities.volunteers') }}
                                    </span>

                                </div>

                            </div>


                            {{-- Divider --}}
                            <div
                                class="my-5
                                       border-t border-slate-100"
                            ></div>


                            {{-- Action --}}
                            <a
                                href="{{ route('opportunities.show', $opportunity) }}"
                                class="inline-flex items-center
                                       justify-center
                                       w-full
                                       px-5 py-3
                                       rounded-lg
                                       bg-emerald-600
                                       text-white
                                       text-sm font-bold
                                       hover:bg-emerald-700
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-emerald-500
                                       focus:ring-offset-2
                                       transition-all duration-200"
                            >

                                {{ __('landing.featured_opportunities.view_details') }}

                                <span class="ms-2">
                                    →
                                </span>

                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- View All --}}
            <div class="mt-10 text-center">

                @auth

                    <a
                        href="{{ route('opportunities.index') }}"
                        class="inline-flex items-center
                               gap-2
                               px-6 py-3
                               rounded-lg
                               border border-emerald-200
                               bg-emerald-50
                               text-emerald-700
                               text-sm font-bold
                               hover:bg-emerald-100
                               hover:border-emerald-300
                               transition-all duration-200"
                    >
                        {{ __('landing.featured_opportunities.view_all') }}

                        <span>→</span>
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center
                               gap-2
                               px-6 py-3
                               rounded-lg
                               border border-emerald-200
                               bg-emerald-50
                               text-emerald-700
                               text-sm font-bold
                               hover:bg-emerald-100
                               hover:border-emerald-300
                               transition-all duration-200"
                    >
                        {{ __('landing.featured_opportunities.view_all') }}

                        <span>→</span>
                    </a>

                @endauth

            </div>

        @else

            {{-- Empty State --}}
            <div
                class="max-w-2xl mx-auto
                       rounded-2xl
                       border border-dashed
                       border-slate-300
                       bg-slate-50
                       px-6 py-12
                       text-center"
            >

                <div
                    class="mx-auto
                           w-14 h-14
                           rounded-2xl
                           bg-emerald-50
                           border border-emerald-100
                           text-emerald-600
                           flex items-center
                           justify-center"
                >

                    <svg
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                        />
                    </svg>

                </div>

                <h3
                    class="mt-5 text-lg font-bold
                           text-slate-900"
                >
                    {{ __('landing.featured_opportunities.empty') }}
                </h3>

            </div>

        @endif

    </div>
</section>

        {{-- =========================================================
             USER ROLES
        ========================================================== --}}
        <section
            id="roles"
            class="py-16 md:py-24
                   bg-white
                   border-y border-slate-200"
        >

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div
                    class="max-w-3xl mx-auto
                           text-center mb-12"
                >

                    <span
                        class="text-xs font-bold uppercase
                               tracking-[0.2em]
                               text-emerald-600"
                    >
                        VolunTeams
                    </span>

                    <h2
                        class="mt-3 text-3xl sm:text-4xl
                               font-extrabold text-slate-950"
                    >
                        {{ __('landing.roles.title') }}
                    </h2>

                    <p class="mt-4 text-slate-600">
                        {{ __('landing.roles.subtitle') }}
                    </p>

                </div>


                <div
                    class="grid grid-cols-1
                           md:grid-cols-3 gap-6"
                >

                    {{-- Admin --}}
                    <x-card
                        class="border-t-4 border-t-emerald-600"
                    >
                        <span
                            class="text-xs font-bold uppercase
                                   tracking-wider
                                   text-emerald-600"
                        >
                            Role 01
                        </span>

                        <h3
                            class="mt-3 text-xl font-bold
                                   text-slate-900"
                        >
                            {{ __('landing.roles.admin.title') }}
                        </h3>

                        <p
                            class="mt-3 text-sm
                                   text-slate-600
                                   leading-relaxed"
                        >
                            {{ __('landing.roles.admin.desc') }}
                        </p>
                    </x-card>


                    {{-- Team Manager --}}
                    <x-card
                        class="border-t-4 border-t-emerald-500"
                    >
                        <span
                            class="text-xs font-bold uppercase
                                   tracking-wider
                                   text-emerald-500"
                        >
                            Role 02
                        </span>

                        <h3
                            class="mt-3 text-xl font-bold
                                   text-slate-900"
                        >
                            {{ __('landing.roles.manager.title') }}
                        </h3>

                        <p
                            class="mt-3 text-sm
                                   text-slate-600
                                   leading-relaxed"
                        >
                            {{ __('landing.roles.manager.desc') }}
                        </p>
                    </x-card>


                    {{-- Member --}}
                    <x-card
                        class="border-t-4 border-t-emerald-400"
                    >
                        <span
                            class="text-xs font-bold uppercase
                                   tracking-wider
                                   text-emerald-400"
                        >
                            Role 03
                        </span>

                        <h3
                            class="mt-3 text-xl font-bold
                                   text-slate-900"
                        >
                            {{ __('landing.roles.member.title') }}
                        </h3>

                        <p
                            class="mt-3 text-sm
                                   text-slate-600
                                   leading-relaxed"
                        >
                            {{ __('landing.roles.member.desc') }}
                        </p>
                    </x-card>

                </div>

            </div>

        </section>


        {{-- =========================================================
             TECHNOLOGY
        ========================================================== --}}
        <section
            id="tech"
            class="py-16 md:py-24
                   bg-slate-50"
        >

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div
                    class="max-w-3xl mx-auto
                           text-center mb-12"
                >

                    <span
                        class="text-xs font-bold uppercase
                               tracking-[0.2em]
                               text-emerald-600"
                    >
                        Technology
                    </span>

                    <h2
                        class="mt-3 text-3xl sm:text-4xl
                               font-extrabold
                               text-slate-950"
                    >
                        {{ __('landing.tech.title') }}
                    </h2>

                    <p
                        class="mt-4 text-slate-600"
                    >
                        {{ __('landing.tech.subtitle') }}
                    </p>

                </div>


                <div
                    class="grid grid-cols-2
                           md:grid-cols-4 gap-4"
                >

                    @foreach ([
                        __('landing.tech.laravel'),
                        __('landing.tech.mysql'),
                        __('landing.tech.tailwind'),
                        __('landing.tech.spatie'),
                    ] as $technology)

                        <x-card
                            class="text-center py-7
                                   hover:-translate-y-1
                                   hover:border-emerald-200
                                   hover:shadow-md"
                        >
                            <div
                                class="text-base font-bold
                                       text-slate-900"
                            >
                                {{ $technology }}
                            </div>
                        </x-card>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- =========================================================
             CALL TO ACTION
        ========================================================== --}}
        <section
            id="cta"
            class="relative overflow-hidden
                   bg-emerald-600 text-white"
        >

            <div
                class="absolute inset-0
                       pointer-events-none
                       overflow-hidden"
            >

                <div
                    class="absolute -top-24 -end-24
                           w-72 h-72
                           rounded-full
                           bg-white/10 blur-3xl"
                ></div>

                <div
                    class="absolute -bottom-32 -start-32
                           w-80 h-80
                           rounded-full
                           bg-emerald-900/20 blur-3xl"
                ></div>

            </div>


            <div
                class="relative max-w-4xl
                       mx-auto px-4 sm:px-6 lg:px-8
                       py-16 md:py-20
                       text-center"
            >

                {{-- Project Logo --}}
                <div
                    class="mx-auto mb-6
                           w-16 h-16
                           rounded-2xl
                           bg-white/10
                           border border-white/20
                           flex items-center
                           justify-center
                           overflow-hidden"
                >

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="{{ __('landing.nav.brand') }}"
                        class="w-12 h-12 object-contain"
                    >

                </div>


                <h2
                    class="text-3xl sm:text-4xl
                           font-extrabold"
                >
                    {{ __('landing.cta.title') }}
                </h2>


                <p
                    class="mt-4 max-w-2xl
                           mx-auto
                           text-emerald-50
                           leading-relaxed"
                >
                    {{ __('landing.cta.subtitle') }}
                </p>


                <div class="mt-8">

                    @auth

                        <x-button
                            href="{{ route('dashboard') }}"
                            variant="secondary"
                            class="px-8 py-3
                                   bg-white
                                   text-emerald-700
                                   hover:bg-emerald-50
                                   border-0"
                        >
                            {{ __('landing.nav.dashboard') }}

                            <span class="ms-2">→</span>
                        </x-button>

                    @else

                        <x-button
                            href="{{ route('register') }}"
                            variant="secondary"
                            class="px-8 py-3
                                   bg-white
                                   text-emerald-700
                                   hover:bg-emerald-50
                                   border-0"
                        >
                            {{ __('landing.cta.button') }}

                            <span class="ms-2">→</span>
                        </x-button>

                    @endauth

                </div>

            </div>

        </section>

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}
    <x-footer />

</body>
</html>