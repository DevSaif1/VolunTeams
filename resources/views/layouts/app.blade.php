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

        <title>
            {{ config('app.name', 'VolunTeams') }}
        </title>

        {{-- Application Assets --}}
        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])
    </head>

    <body class="min-h-screen bg-surface text-ink font-sans antialiased">

        <div class="min-h-screen">

            {{-- Navigation --}}
            @include('layouts.navigation')

            {{-- Optional Page Heading --}}
            @isset($header)
                <header class="bg-white border-b border-line">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Page Content --}}
            <main>
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </main>

        </div>

    </body>
</html>