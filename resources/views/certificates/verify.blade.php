@extends('layouts.app')

@section('content')

@php
    $isArabic = app()->getLocale() === 'ar';
@endphp

<style>
    /* =========================================================
       VOLUNTEAMS VERIFY PAGE ANIMATIONS
    ========================================================= */

    @keyframes volunFadeUp {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes volunFadeLeft {
        from {
            opacity: 0;
            transform: translateX(-18px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes volunFadeRight {
        from {
            opacity: 0;
            transform: translateX(18px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .volun-page-enter {
        animation: volunFadeUp .55s ease-out both;
    }

    .volun-brand-enter-ltr {
        animation: volunFadeLeft .65s ease-out .08s both;
    }

    .volun-brand-enter-rtl {
        animation: volunFadeRight .65s ease-out .08s both;
    }

    .volun-card-enter {
        animation: volunFadeUp .65s ease-out .16s both;
    }

    @media (prefers-reduced-motion: reduce) {
        .volun-page-enter,
        .volun-brand-enter-ltr,
        .volun-brand-enter-rtl,
        .volun-card-enter {
            animation: none;
        }
    }
</style>


{{-- =========================================================
     PAGE
========================================================= --}}

<div
    dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
    class="
        min-h-screen
        bg-gradient-to-br
        from-indigo-50
        via-white
        to-emerald-50
        py-6
        sm:py-8
        lg:py-10
        volun-page-enter
    "
>

    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6">


        {{-- =====================================================
             MAIN CONTAINER

             English:
             Brand        | Verification

             Arabic:
             Verification | Brand
        ====================================================== --}}

        <div
            dir="ltr"
            class="
                flex
                flex-col
                lg:flex-row
                {{ $isArabic ? 'lg:flex-row-reverse' : '' }}

                overflow-hidden
                rounded-2xl
                border
                border-gray-200
                bg-white
                shadow-sm
            "
        >


            {{-- =================================================
                 BRAND / SYSTEM PANEL
            ================================================== --}}

            <section
                dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
                class="
                    relative
                    w-full
                    lg:w-1/2

                    min-h-[430px]
                    sm:min-h-[500px]
                    lg:min-h-[650px]

                    overflow-hidden

                    bg-gradient-to-br
                    from-indigo-600
                    via-indigo-600
                    to-emerald-500

                    text-white

                    p-7
                    sm:p-8
                    lg:p-9

                    flex
                    flex-col
                    justify-between

                    {{ $isArabic
                        ? 'text-right volun-brand-enter-rtl'
                        : 'text-left volun-brand-enter-ltr'
                    }}
                "
            >

                {{-- Decorative circle top --}}
                <div
                    class="
                        absolute
                        -top-20
                        -right-20
                        w-60
                        h-60
                        rounded-full
                        bg-white/10
                        pointer-events-none
                    "
                ></div>


                {{-- Decorative circle bottom --}}
                <div
                    class="
                        absolute
                        -bottom-24
                        -left-20
                        w-64
                        h-64
                        rounded-full
                        bg-emerald-300/10
                        pointer-events-none
                    "
                ></div>


                {{-- Brand content --}}
                <div class="relative z-10">

                    {{-- Logo --}}
                    <div class="flex justify-start">

                        <div
                            class="
                                w-24
                                h-24
                                sm:w-28
                                sm:h-28

                                rounded-2xl

                                bg-white/10
                                border
                                border-white/20

                                flex
                                items-center
                                justify-center

                                overflow-hidden

                                transition
                                duration-300

                                hover:bg-white/15
                                hover:scale-[1.02]
                            "
                        >

                            <x-application-logo
                                class="
                                    w-20
                                    h-20
                                    sm:w-24
                                    sm:h-24
                                    object-contain
                                "
                            />

                        </div>

                    </div>


                    {{-- Brand name --}}
                    <p
                        class="
                            mt-7
                            text-xs
                            sm:text-sm
                            font-semibold
                            tracking-[0.22em]
                            text-white/80
                        "
                    >
                        VOLUNTEAMS
                    </p>


                    {{-- Main title --}}
                    <h2
                        class="
                            mt-4
                            text-3xl
                            sm:text-4xl
                            lg:text-[2.35rem]
                            font-bold
                            leading-[1.12]
                            max-w-md
                            {{ $isArabic ? 'ml-auto' : '' }}
                        "
                    >

                        @if($isArabic)

                            منصة ذكية لإدارة الفرق والفرص التطوعية

                        @else

                            Smart management for volunteer teams and opportunities

                        @endif

                    </h2>


                    {{-- Description --}}
                    <p
                        class="
                            mt-5
                            text-sm
                            sm:text-base
                            leading-7
                            text-white/80
                            max-w-md
                            {{ $isArabic ? 'ml-auto' : '' }}
                        "
                    >

                        @if($isArabic)

                            نظم الفرق، أدر الفرص، تابع الطلبات وساعات التطوع، واحتفظ بشهاداتك في مكان واحد.

                        @else

                            Manage teams, opportunities, applications, volunteer hours, and certificates in one place.

                        @endif

                    </p>

                </div>


                {{-- =================================================
                     BRAND FOOTER
                     
                     IMPORTANT:
                     dir="ltr" is intentionally used here so that
                     justify-end always means physical right side.
                     
                     Arabic  -> Bottom Right
                     English -> Bottom Left
                ================================================== --}}

                <div
                    dir="ltr"
                    class="
                        relative
                        z-10
                        mt-10
                        flex
                        w-full
                        {{ $isArabic ? 'justify-end' : 'justify-start' }}
                    "
                >

                    <div
                        class="
                            flex
                            flex-row
                            items-center
                            gap-3
                            text-xs
                            sm:text-sm
                            font-medium
                            text-white/80
                        "
                    >

                        @if($isArabic)

                            <span>
                                نظام إدارة تطوعي متكامل
                            </span>

                        @else

                            <span>
                                Complete volunteer management platform
                            </span>

                        @endif

                        <span
                            class="
                                w-2
                                h-2
                                rounded-full
                                bg-emerald-300
                                shrink-0
                            "
                        ></span>

                    </div>

                </div>

            </section>



            {{-- =================================================
                 VERIFICATION PANEL
            ================================================== --}}

            <section
                dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
                class="
                    w-full
                    lg:w-1/2

                    bg-white

                    p-5
                    sm:p-7
                    lg:p-8

                    flex
                    flex-col

                    min-w-0
                "
            >

                {{-- PAGE HEADER --}}
                <div
                    class="
                        text-center
                        mb-6
                        sm:mb-7
                    "
                >

                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2
                            text-indigo-600
                            font-bold
                            tracking-widest
                            text-xs
                            sm:text-sm
                        "
                    >

                        <span
                            class="
                                w-2
                                h-2
                                rounded-full
                                bg-indigo-600
                            "
                        ></span>

                        VOLUNTEAMS

                    </div>


                    <h1
                        class="
                            mt-3
                            text-3xl
                            sm:text-4xl
                            font-bold
                            text-gray-900
                            leading-tight
                        "
                    >
                        {{ __('certificates.verify.title') }}
                    </h1>


                    <p
                        class="
                            mt-2
                            text-sm
                            sm:text-base
                            text-gray-600
                            leading-6
                        "
                    >
                        {{ __('certificates.verify.description') }}
                    </p>

                </div>



                {{-- =================================================
                     CERTIFICATE CARD
                ================================================== --}}

                <div
                    class="
                        bg-white
                        border
                        border-gray-200
                        rounded-2xl
                        shadow-sm
                        overflow-hidden

                        volun-card-enter
                    "
                >

                    {{-- Certificate header --}}
                    <div
                        class="
                            bg-gradient-to-r
                            from-indigo-50
                            to-white

                            border-b
                            border-gray-200

                            p-5
                        "
                    >

                        <div
                            class="
                                flex
                                flex-col
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-3
                            "
                        >

                            {{-- Certificate title --}}
                            <div class="min-w-0">

                                <p
                                    class="
                                        text-[11px]
                                        font-semibold
                                        uppercase
                                        tracking-wider
                                        text-indigo-600
                                    "
                                >
                                    {{ __('certificates.verify.verified_certificate') }}
                                </p>


                                <h2
                                    class="
                                        mt-1.5
                                        text-xl
                                        sm:text-2xl
                                        font-bold
                                        text-gray-900
                                        break-words
                                    "
                                >
                                    {{ $certificate->user?->name ?? __('certificates.verify.volunteer') }}
                                </h2>

                            </div>


                            {{-- Valid badge --}}
                            <span
                                class="
                                    inline-flex
                                    w-fit
                                    shrink-0
                                    items-center
                                    gap-2

                                    px-3.5
                                    py-2

                                    rounded-full

                                    bg-green-50
                                    border
                                    border-green-200

                                    text-green-700

                                    text-xs
                                    sm:text-sm

                                    font-semibold
                                "
                            >

                                <span
                                    class="
                                        w-2
                                        h-2
                                        rounded-full
                                        bg-green-500
                                    "
                                ></span>

                                {{ __('certificates.verify.valid_certificate') }}

                            </span>

                        </div>

                    </div>



                    {{-- =================================================
                         CERTIFICATE INFORMATION
                    ================================================== --}}

                    <div class="p-5 space-y-5">


                        {{-- Certificate code --}}
                        <div class="min-w-0">

                            <p
                                class="
                                    text-[11px]
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-gray-500
                                "
                            >
                                {{ __('certificates.verify.certificate_code') }}
                            </p>


                            <div
                                dir="ltr"
                                class="
                                    mt-2
                                    w-full
                                    min-w-0

                                    px-3
                                    py-2.5

                                    rounded-lg

                                    bg-gray-100
                                    border
                                    border-gray-200

                                    font-mono
                                    text-xs
                                    font-semibold
                                    text-gray-800

                                    break-all
                                    whitespace-normal
                                    leading-5

                                    overflow-hidden

                                    text-left
                                "
                            >
                                {{ $certificate->certificate_code }}
                            </div>

                        </div>



                        {{-- Details grid --}}
                        <div
                            class="
                                grid
                                grid-cols-1
                                sm:grid-cols-2
                                gap-3.5
                            "
                        >

                            {{-- Volunteer --}}
                            <div
                                class="
                                    min-w-0
                                    p-4
                                    rounded-xl
                                    bg-gray-50
                                    border
                                    border-gray-200
                                "
                            >

                                <p
                                    class="
                                        text-[11px]
                                        font-semibold
                                        uppercase
                                        tracking-wider
                                        text-gray-500
                                    "
                                >
                                    {{ __('certificates.verify.volunteer') }}
                                </p>


                                <p
                                    class="
                                        mt-1.5
                                        text-sm
                                        font-semibold
                                        text-gray-900
                                        break-words
                                    "
                                >
                                    {{ $certificate->user?->name ?? __('certificates.verify.not_available') }}
                                </p>

                            </div>



                            {{-- Opportunity --}}
                            <div
                                class="
                                    min-w-0
                                    p-4
                                    rounded-xl
                                    bg-gray-50
                                    border
                                    border-gray-200
                                "
                            >

                                <p
                                    class="
                                        text-[11px]
                                        font-semibold
                                        uppercase
                                        tracking-wider
                                        text-gray-500
                                    "
                                >
                                    {{ __('certificates.verify.opportunity') }}
                                </p>


                                <p
                                    class="
                                        mt-1.5
                                        text-sm
                                        font-semibold
                                        text-gray-900
                                        break-words
                                    "
                                >
                                    {{ $certificate->opportunity?->title ?? __('certificates.verify.general_certificate') }}
                                </p>

                            </div>



                            {{-- Issued By --}}
                            <div
                                class="
                                    min-w-0
                                    p-4
                                    rounded-xl
                                    bg-gray-50
                                    border
                                    border-gray-200
                                "
                            >

                                <p
                                    class="
                                        text-[11px]
                                        font-semibold
                                        uppercase
                                        tracking-wider
                                        text-gray-500
                                    "
                                >
                                    {{ __('certificates.verify.issued_by') }}
                                </p>


                                <p
                                    class="
                                        mt-1.5
                                        text-sm
                                        font-semibold
                                        text-gray-900
                                        break-words
                                    "
                                >
                                    {{ $certificate->issuer?->name ?? __('certificates.verify.not_available') }}
                                </p>

                            </div>



                            {{-- Issued At --}}
                            <div
                                class="
                                    min-w-0
                                    p-4
                                    rounded-xl
                                    bg-gray-50
                                    border
                                    border-gray-200
                                "
                            >

                                <p
                                    class="
                                        text-[11px]
                                        font-semibold
                                        uppercase
                                        tracking-wider
                                        text-gray-500
                                    "
                                >
                                    {{ __('certificates.verify.issued_at') }}
                                </p>


                                <p
                                    class="
                                        mt-1.5
                                        text-sm
                                        font-semibold
                                        text-gray-900
                                    "
                                >
                                    {{
                                        $certificate->issued_at
                                            ? \Carbon\Carbon::parse($certificate->issued_at)->format('M d, Y')
                                            : __('certificates.verify.not_available')
                                    }}
                                </p>

                            </div>

                        </div>



                        {{-- =================================================
                             CERTIFICATE FILE BUTTON
                        ================================================== --}}

                        @if($certificate->file_path)

                            <div class="pt-1 text-center">

                                <a
                                    href="{{ asset('storage/' . $certificate->file_path) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"

                                    class="
                                        inline-flex
                                        items-center
                                        justify-center
                                        gap-2

                                        px-5
                                        py-2.5

                                        rounded-xl

                                        bg-indigo-600
                                        text-white

                                        text-sm
                                        font-semibold

                                        shadow-sm

                                        hover:bg-indigo-700
                                        hover:-translate-y-0.5

                                        transition
                                        duration-200
                                    "
                                >
                                    📄
                                    {{ __('certificates.verify.view_certificate_file') }}
                                </a>

                            </div>

                        @endif

                    </div>

                </div>

            </section>

        </div>


            {{-- Copyright --}}
            <div
                dir="ltr"
                class="mt-5 text-center text-xs text-gray-500"
            >
                © {{ date('Y') }} VolunTeams
            </div>

    </div>

</div>

@endsection