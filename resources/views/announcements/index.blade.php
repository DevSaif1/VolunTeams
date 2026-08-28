@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- =========================================================
             Header
        ========================================================== --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">

            <div>

                {{-- VolunTeams Label --}}
                <div class="flex items-center gap-2 mb-3">

                    <span class="h-2.5 w-2.5 rounded-full bg-indigo-600"></span>

                    <span class="text-sm font-bold tracking-[0.22em] text-indigo-600 uppercase">
                        VOLUNTEAMS
                    </span>

                </div>

                <h1 class="text-4xl font-bold text-gray-900">
                    {{ __('announcements.index.title') }}
                </h1>

                <p class="mt-2 text-lg text-gray-600">
                    {{ __('announcements.index.description') }}
                </p>

            </div>


            {{-- Admin: Add Announcement --}}
            @if(auth()->user()->hasRole('Admin'))

                <a href="{{ route('announcements.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg
                          bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold
                          shadow-sm transition duration-200 whitespace-nowrap">

                    <span class="text-lg leading-none">+</span>

                    {{ __('announcements.index.add_announcement') }}

                </a>

            @endif

        </div>


        {{-- =========================================================
             Success Message
        ========================================================== --}}
        @if (session('success'))

            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 shadow-sm">

                <div class="flex items-center gap-3">

                    <svg class="h-5 w-5 text-green-600 flex-shrink-0"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20"
                         fill="currentColor">

                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l4 4z"
                              clip-rule="evenodd" />

                    </svg>

                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =========================================================
             Main Card
        ========================================================== --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">


            {{-- =====================================================
                 Card Header
            ====================================================== --}}
            <div class="px-6 sm:px-8 py-7 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div class="h-14 w-14 rounded-xl bg-indigo-100 border border-indigo-200
                                flex items-center justify-center text-indigo-600 flex-shrink-0">

                        <svg class="h-7 w-7"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h7l2 2h5a2 2 0 012 2v10a2 2 0 01-2 2z" />

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8 11h8M8 15h5" />

                        </svg>

                    </div>


                    {{-- Card Title --}}
                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ __('announcements.index.title') }}
                        </h2>

                        <p class="mt-1 text-base text-gray-600">
                            {{ __('announcements.index.description') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 Table
            ====================================================== --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1050px] table-fixed">

                    {{-- Table Header --}}
                    <thead class="bg-gray-50 border-b border-gray-200">

                        <tr>

                            {{-- Announcement --}}
                            <th class="w-[17%] px-5 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                {{ __('announcements.index.announcement') }}
                            </th>


                            {{-- Content --}}
                            <th class="w-[23%] px-5 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                {{ __('announcements.index.content') }}
                            </th>


                            {{-- Created By --}}
                            <th class="w-[17%] px-5 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                {{ __('announcements.index.created_by') }}
                            </th>


                            {{-- Status --}}
                            <th class="w-[10%] px-5 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                {{ __('announcements.index.status') }}
                            </th>


                            {{-- Created At --}}
                            <th class="w-[13%] px-5 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                {{ __('announcements.index.created_at') }}
                            </th>


                            {{-- Actions --}}
                            <th class="w-[20%] px-5 py-4 text-right text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                {{ __('announcements.index.actions') }}
                            </th>

                        </tr>

                    </thead>


                    {{-- =================================================
                         Table Body
                    ================================================== --}}
                    <tbody class="divide-y divide-gray-200">

                        @forelse ($announcements as $announcement)

                            <tr class="hover:bg-gray-50 transition duration-150">


                                {{-- =================================================
                                     Announcement
                                ================================================== --}}
                                <td class="px-5 py-5 align-middle">

                                    <div class="font-semibold text-gray-900 truncate"
                                         title="{{ $announcement->title }}">

                                        {{ $announcement->title }}

                                    </div>

                                </td>


                                {{-- =================================================
                                     Content
                                ================================================== --}}
                                <td class="px-5 py-5 align-middle">

                                    <div class="text-sm text-gray-600 line-clamp-2"
                                         title="{{ $announcement->content }}">

                                        {{ \Illuminate\Support\Str::limit($announcement->content, 90) }}

                                    </div>

                                </td>


                                {{-- =================================================
                                     Created By
                                ================================================== --}}
                                <td class="px-5 py-5 align-middle">

                                    @if($announcement->creator)

                                        <div class="text-sm font-medium text-gray-900 truncate">
                                            {{ $announcement->creator->name }}
                                        </div>

                                        @if($announcement->creator->email)

                                            <div class="mt-1 text-xs text-gray-500 truncate">
                                                {{ $announcement->creator->email }}
                                            </div>

                                        @endif

                                    @else

                                        <span class="text-sm text-gray-500">
                                            {{ __('announcements.index.unknown_user') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     Status
                                ================================================== --}}
                                <td class="px-5 py-5 align-middle">

                                    @if ($announcement->is_active)

                                        <span class="inline-flex items-center justify-center
                                                     px-3 py-1 rounded-full text-xs font-semibold
                                                     bg-green-50 text-green-700 border border-green-100">

                                            {{ __('announcements.index.active') }}

                                        </span>

                                    @else

                                        <span class="inline-flex items-center justify-center
                                                     px-3 py-1 rounded-full text-xs font-semibold
                                                     bg-gray-100 text-gray-700 border border-gray-200">

                                            {{ __('announcements.index.inactive') }}

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     Created At
                                ================================================== --}}
                                <td class="px-5 py-5 align-middle">

                                    <div class="text-sm text-gray-700 whitespace-nowrap">

                                        {{ $announcement->created_at?->format('M d, Y') ?? __('announcements.index.not_available') }}

                                    </div>

                                </td>


                                {{-- =================================================
                                     Actions
                                ================================================== --}}
                                <td class="px-4 py-5 align-middle">

                                    <div class="flex items-center justify-end gap-2 whitespace-nowrap">

                                        {{-- View --}}
                                        <a href="{{ route('announcements.show', $announcement) }}"
                                           class="inline-flex items-center justify-center
                                                  px-3 py-2 rounded-lg
                                                  border border-gray-300
                                                  bg-white
                                                  text-sm font-medium text-gray-700
                                                  hover:bg-gray-50
                                                  transition duration-200">

                                            {{ __('announcements.index.view') }}

                                        </a>


                                        {{-- Admin Actions --}}
                                        @if(auth()->user()->hasRole('Admin'))

                                            {{-- Edit --}}
                                            <a href="{{ route('announcements.edit', $announcement) }}"
                                               class="inline-flex items-center justify-center
                                                      px-3 py-2 rounded-lg
                                                      bg-indigo-600
                                                      hover:bg-indigo-700
                                                      text-white
                                                      text-sm font-semibold
                                                      transition duration-200">

                                                {{ __('announcements.index.edit') }}

                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('announcements.destroy', $announcement) }}"
                                                  method="POST"
                                                  class="inline-flex">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        onclick="return confirm('{{ __('announcements.index.delete_confirmation') }}')"
                                                        class="inline-flex items-center justify-center
                                                               px-3 py-2 rounded-lg
                                                               border border-red-200
                                                               bg-red-50
                                                               text-red-600
                                                               hover:bg-red-100
                                                               text-sm font-medium
                                                               transition duration-200">

                                                    {{ __('announcements.index.delete') }}

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>


                        @empty

                            {{-- =================================================
                                 Empty State
                            ================================================== --}}
                            <tr>

                                <td colspan="6" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center justify-center">

                                        <div class="h-14 w-14 rounded-xl bg-gray-100
                                                    flex items-center justify-center mb-4">

                                            <svg class="h-7 w-7 text-gray-400"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="1.8">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />

                                            </svg>

                                        </div>


                                        <p class="text-base font-semibold text-gray-900">
                                            {{ __('announcements.index.no_announcements') }}
                                        </p>


                                        @if(auth()->user()->hasRole('Admin'))

                                            <a href="{{ route('announcements.create') }}"
                                               class="mt-2 text-sm font-semibold text-indigo-600
                                                      hover:text-indigo-800 transition">

                                                {{ __('announcements.index.create_first_announcement') }}

                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                 Pagination
            ====================================================== --}}
            @if ($announcements->hasPages())

                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">

                    {{ $announcements->links() }}

                </div>

            @endif

        </div>

    </div>

@endsection