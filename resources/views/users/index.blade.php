@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold tracking-[0.18em] uppercase text-indigo-600">
                    VolunTeams
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-950">
                {{ __('users.title') }}
            </h1>

            <p class="mt-2 text-sm sm:text-base text-slate-500">
                {{ __('users.description') }}
            </p>
        </div>


        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-5 w-5 text-emerald-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <p class="text-sm font-semibold text-emerald-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        @endif


        {{-- Error Message --}}
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100">
                        <svg class="h-5 w-5 text-red-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.64h15.58a2 2 0 001.74 0 1.74-2.64L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-red-900">
                            {{ __('users.edit.role_information') }}
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        @endif


        {{-- Users Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_8px_30px_rgba(15,23,42,0.05)]">

            {{-- Card Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 via-white to-white px-6 py-6 sm:px-8">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">

                        <svg class="h-6 w-6"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 20h5v-1a6 6 0 00-12 0v1h5m-3-9a4 4 0 110-8 4 4 0 010 8zm-7 9H2v-1a6 6 0 0112 0v1H7z"/>
                        </svg>

                    </div>

                    <div>
                        <h2 class="text-base font-bold text-slate-950">
                            {{ __('users.table.title') }}
                        </h2>

                        <p class="mt-0.5 text-sm text-slate-500">
                            {{ __('users.table.description') }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="border-b border-slate-100 bg-slate-50/70">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('users.table.user') }}
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('users.table.email') }}
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('users.table.role') }}
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('users.table.registered') }}
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('users.table.action') }}
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($users as $user)

                            <tr class="transition hover:bg-slate-50/70">

                                {{-- User --}}
                                <td class="px-6 py-5 whitespace-nowrap">

                                    <div class="flex items-center gap-3">

                                        <div class="relative shrink-0">

                                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-sm font-bold text-indigo-600 ring-1 ring-indigo-100">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>

                                            @if($user->id === auth()->id())
                                                <span class="absolute -right-1 -bottom-1 h-4 w-4 rounded-full border-2 border-white bg-emerald-500"></span>
                                            @endif

                                        </div>

                                        <div class="min-w-0">

                                            <div class="max-w-[220px] truncate text-sm font-bold text-slate-900">
                                                {{ $user->name }}
                                            </div>

                                            @if($user->id === auth()->id())
                                                <span class="mt-1 inline-flex rounded-full bg-indigo-50 px-2 py-0.5 text-[10px] font-bold text-indigo-600">
                                                    {{ __('users.edit.you') }}
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                    {{ $user->email }}
                                </td>


                                {{-- Role --}}
                                <td class="px-6 py-5 whitespace-nowrap">

                                    @php
                                        $role = $user->getRoleNames()->first();

                                        $roleConfig = match ($role) {
                                            'Admin' => [
                                                'label' => __('users.roles.admin'),
                                                'class' => 'bg-violet-50 text-violet-700 border-violet-200',
                                                'dot' => 'bg-violet-500',
                                            ],

                                            'Team Manager' => [
                                                'label' => __('users.roles.team_manager'),
                                                'class' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                'dot' => 'bg-blue-500',
                                            ],

                                            'Member' => [
                                                'label' => __('users.roles.member'),
                                                'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                'dot' => 'bg-emerald-500',
                                            ],

                                            default => [
                                                'label' => __('users.roles.no_role'),
                                                'class' => 'bg-slate-50 text-slate-600 border-slate-200',
                                                'dot' => 'bg-slate-400',
                                            ],
                                        };
                                    @endphp

                                    <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-semibold {{ $roleConfig['class'] }}">

                                        <span class="h-1.5 w-1.5 rounded-full {{ $roleConfig['dot'] }}"></span>

                                        {{ $roleConfig['label'] }}

                                    </span>

                                </td>


                                {{-- Registered --}}
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-500">
                                    {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                </td>


                                {{-- Action --}}
                                <td class="px-6 py-5 whitespace-nowrap text-right">

                                    @if($user->id !== auth()->id())

                                        <a href="{{ route('users.edit', $user) }}"
                                           class="inline-flex items-center gap-2 rounded-xl border border-indigo-200 bg-white px-4 py-2 text-xs font-bold text-indigo-600 transition hover:bg-indigo-50">

                                            <svg class="h-4 w-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536M9 11l7.768-7.768a2.121 2.121 0 013 3L12 14H9v-3z"/>
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h4"/>
                                            </svg>

                                            {{ __('users.actions.edit_role') }}

                                        </a>

                                    @else

                                        <span class="text-xs font-semibold text-slate-400">
                                            {{ __('users.actions.current_account') }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                            <svg class="h-7 w-7"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M17 20h5v-1a6 6 0 00-12 0v1h5m-3-9a4 4 0 110-8 4 4 0 010 8zm-7 9H2v-1a6 6 0 0112 0v1H7z"/>
                                            </svg>

                                        </div>

                                        <p class="mt-4 text-sm font-bold text-slate-700">
                                            {{ __('users.messages.no_users') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ __('users.messages.users_will_appear') }}
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($users->hasPages())

                <div class="border-t border-slate-100 bg-slate-50/50 px-6 py-4">
                    {{ $users->links() }}
                </div>

            @endif

        </div>

    </div>
</div>
@endsection