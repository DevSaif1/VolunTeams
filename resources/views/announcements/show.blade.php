@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="h-2.5 w-2.5 rounded-full bg-indigo-600"></span>

                    <span class="text-sm font-semibold tracking-[0.22em] text-indigo-600 uppercase">
                        VOLUNTEAMS
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
                    {{ __('announcements.show.title') }}
                </h1>

                <p class="mt-2 text-sm sm:text-base text-gray-600">
                    {{ __('announcements.show.description') }}
                </p>
            </div>

            {{-- Top Actions --}}
            <div class="flex items-center gap-3 shrink-0">

                <a href="{{ route('announcements.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition">

                    ← {{ __('announcements.show.back_to_announcements') }}

                </a>

                @if(auth()->user()->hasRole('Admin'))
                    <a href="{{ route('announcements.edit', $announcement) }}"
                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition">

                        {{ __('announcements.show.edit_announcement') }} →

                    </a>
                @endif

            </div>
        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3">
                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>
            </div>
        @endif


        {{-- Main Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- Card Header --}}
            <div class="p-6 sm:p-8 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

                    {{-- Announcement Identity --}}
                    <div class="flex items-center gap-4">

                        {{-- Icon --}}
                        <div class="h-16 w-16 shrink-0 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-8 w-8"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M4.5 6.75A2.25 2.25 0 016.75 4.5h10.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25V6.75z" />

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M8 9h8M8 12h8M8 15h5" />

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">
                                {{ __('announcements.show.announcement') }}
                            </p>

                            <h2 class="mt-1 text-xl sm:text-2xl font-bold text-gray-900 break-words">
                                {{ $announcement->title }}
                            </h2>

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="shrink-0">

                        @if ($announcement->is_active)

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">

                                <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                {{ __('announcements.show.active') }}

                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-700 border border-gray-200">

                                <span class="h-2 w-2 rounded-full bg-gray-400"></span>

                                {{ __('announcements.show.inactive') }}

                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Details --}}
            <div class="p-6 sm:p-8">

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                    {{-- Content --}}
                    <div class="sm:col-span-2 p-5 rounded-xl border border-gray-200 bg-white">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('announcements.show.content') }}
                        </dt>

                        <dd class="mt-3 bg-gray-50 border border-gray-100 rounded-lg p-5 text-sm sm:text-base text-gray-900 leading-7 whitespace-pre-line">
                            {{ $announcement->content }}
                        </dd>

                    </div>


                    {{-- Created By --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('announcements.show.created_by') }}
                        </dt>

                        <dd class="mt-2 text-sm font-semibold text-gray-900">
                            {{ $announcement->creator?->name ?? __('announcements.show.unknown_user') }}
                        </dd>

                        @if ($announcement->creator?->email)
                            <dd class="mt-1 text-xs text-gray-500">
                                {{ $announcement->creator->email }}
                            </dd>
                        @endif

                    </div>


                    {{-- Status --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('announcements.show.status') }}
                        </dt>

                        <dd class="mt-2">

                            @if ($announcement->is_active)

                                <span class="inline-flex items-center gap-2 text-sm font-semibold text-green-700">

                                    <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                    {{ __('announcements.show.active') }}

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600">

                                    <span class="h-2 w-2 rounded-full bg-gray-400"></span>

                                    {{ __('announcements.show.inactive') }}

                                </span>

                            @endif

                        </dd>

                    </div>


                    {{-- Created At --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('announcements.show.created_at') }}
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-gray-900">

                            {{ $announcement->created_at
                                ? $announcement->created_at->format('M d, Y h:i A')
                                : __('announcements.show.not_available')
                            }}

                        </dd>

                    </div>


                    {{-- Last Updated --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('announcements.show.last_updated_at') }}
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-gray-900">

                            {{ $announcement->updated_at
                                ? $announcement->updated_at->format('M d, Y h:i A')
                                : __('announcements.show.not_available')
                            }}

                        </dd>

                    </div>

                </dl>

            </div>

        </div>

    </div>
@endsection