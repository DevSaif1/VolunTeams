@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-8">

        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold tracking-[0.2em] text-indigo-600 uppercase">
                    VolunTeams
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-950 tracking-tight">
                {{ __('teams.title') }}
            </h1>

            <p class="mt-2 text-sm sm:text-base text-gray-600">
                @if(auth()->user()->hasRole('Admin'))
                    {{ __('teams.manage_description') }}
                @else
                    {{ __('teams.browse_description') }}
                @endif
            </p>
        </div>

        {{-- Create --}}
        @if(auth()->user()->hasRole('Admin'))

            <a href="{{ route('teams.create') }}"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-3
                      rounded-xl
                      bg-indigo-600
                      text-white
                      text-sm font-semibold
                      shadow-sm
                      hover:bg-indigo-700
                      hover:-translate-y-0.5
                      focus:outline-none
                      focus:ring-2
                      focus:ring-indigo-500
                      focus:ring-offset-2
                      transition-all duration-200">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4v16m8-8H4" />

                </svg>

                {{ __('teams.create_team') }}

            </a>

        @endif

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <div class="flex items-start gap-3">

                <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7" />

                    </svg>

                </div>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Teams Card --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-indigo-50/70 to-white">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M17 20h5v-2a4 4 0 00-4-4h-1
                                 M9 20H4v-2a4 4 0 014-4h1
                                 M12 14a4 4 0 100-8 4 4 0 000 8z
                                 M16 3.13a4 4 0 010 7.75
                                 M8 3.13a4 4 0 000 7.75" />

                    </svg>

                </div>

                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        {{ __('teams.title') }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-0.5">
                        {{ __('teams.manage_description') }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50/80 border-b border-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold
                                   text-gray-400 uppercase tracking-wider">
                            {{ __('teams.team_name') }}
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold
                                   text-gray-400 uppercase tracking-wider">
                            {{ __('teams.manager') }}
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold
                                   text-gray-400 uppercase tracking-wider">
                            {{ __('teams.email') }}
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold
                                   text-gray-400 uppercase tracking-wider">
                            {{ __('teams.status') }}
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold
                                   text-gray-400 uppercase tracking-wider">
                            {{ __('teams.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($teams as $team)

                        <tr class="group hover:bg-gray-50/70 transition-colors duration-150">

                            {{-- Team --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    @if($team->logo_path)

                                        <img
                                            src="{{ asset('storage/' . $team->logo_path) }}"
                                            alt="{{ $team->name }}"
                                            class="h-11 w-11 rounded-xl object-cover border border-gray-200 shadow-sm"
                                        >

                                    @else

                                        <div class="h-11 w-11 rounded-xl
                                                    bg-indigo-50
                                                    border border-indigo-100
                                                    flex items-center justify-center
                                                    text-sm font-bold text-indigo-600">

                                            {{ strtoupper(substr($team->name, 0, 2)) }}

                                        </div>

                                    @endif

                                    <div class="min-w-0">

                                        <div class="text-sm font-bold text-gray-900 truncate max-w-xs">
                                            {{ $team->name }}
                                        </div>

                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ __('teams.team_name') }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Manager --}}
                            <td class="px-6 py-5">

                                <div class="text-sm font-medium text-gray-800">
                                    {{ $team->manager?->name ?? __('teams.not_available') }}
                                </div>

                                @if($team->manager?->email)

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $team->manager->email }}
                                    </div>

                                @endif

                            </td>


                            {{-- Email --}}
                            <td class="px-6 py-5 text-sm text-gray-600">

                                {{ $team->email ?? __('teams.not_available') }}

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-5">

                                @if($team->is_active ?? true)

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-green-50
                                                 border border-green-200
                                                 text-xs font-semibold
                                                 text-green-700">

                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                        {{ __('teams.active') }}

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-red-50
                                                 border border-red-200
                                                 text-xs font-semibold
                                                 text-red-700">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        {{ __('teams.inactive') }}

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('teams.show', $team) }}"
                                       class="inline-flex items-center gap-1.5
                                              px-3 py-2
                                              rounded-lg
                                              border border-gray-200
                                              bg-white
                                              text-xs font-semibold
                                              text-gray-700
                                              hover:bg-gray-50
                                              hover:border-gray-300
                                              transition">

                                        {{ __('teams.view') }}

                                    </a>


                                    @if(auth()->user()->hasRole('Admin'))

                                        {{-- Edit --}}
                                        <a href="{{ route('teams.edit', $team) }}"
                                           class="inline-flex items-center gap-1.5
                                                  px-3 py-2
                                                  rounded-lg
                                                  bg-indigo-600
                                                  text-xs font-semibold
                                                  text-white
                                                  hover:bg-indigo-700
                                                  transition">

                                            {{ __('teams.edit_action') }}

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('teams.destroy', $team) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('{{ __('teams.delete_confirmation') }}')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-2
                                                           rounded-lg
                                                           border border-red-200
                                                           bg-red-50
                                                           text-xs font-semibold
                                                           text-red-600
                                                           hover:bg-red-100
                                                           transition">

                                                {{ __('teams.delete') }}

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="flex h-14 w-14 items-center justify-center
                                                rounded-2xl bg-gray-100 text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-7 h-7"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="1.5">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M17 20h5v-2a4 4 0 00-4-4h-1
                                                     M9 20H4v-2a4 4 0 014-4h1
                                                     M12 14a4 4 0 100-8 4 4 0 000 8z" />

                                        </svg>

                                    </div>

                                    <p class="mt-4 text-sm font-semibold text-gray-700">
                                        {{ __('teams.no_teams') }}
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($teams->hasPages())

            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $teams->links() }}
            </div>

        @endif

    </div>

</div>

@endsection