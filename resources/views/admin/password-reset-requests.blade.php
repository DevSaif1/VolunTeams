@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="mb-8">

        <div class="mb-2 flex items-center gap-2">
            <span class="h-3 w-3 rounded-full bg-indigo-600"></span>

            <span class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">
                VolunTeams
            </span>
        </div>

        <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
            Password Reset Requests
        </h1>

        <p class="mt-2 text-base text-slate-500">
            Review and manage password reset requests from users.
        </p>

    </div>


    {{-- Success / Status Message --}}
    @if (session('success') || session('status'))
        <div class="mb-6 rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') ?? session('status') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            {{ $errors->first() }}
        </div>
    @endif


    {{-- Main Card --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Card Header --}}
        <div class="border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-white px-6 py-6">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 7a3 3 0 10-6 0v2m-1 0h8a2 2 0 012 2v7a2 2 0 01-2 2H8a2 2 0 01-2-2v-7a2 2 0 012-2z"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Pending Requests
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Password changes require administrator approval.
                    </p>

                </div>

            </div>

        </div>


        {{-- Requests --}}
        @if ($requests->count())

            {{-- Desktop Table --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                User
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Email
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Role
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Requested
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-200 bg-white">

                        @foreach ($requests as $resetRequest)

                            @php
                                $user = $resetRequest->user;
                                $role = $user?->getRoleNames()->first() ?? 'Member';
                                $initials = strtoupper(substr($user?->name ?? '?', 0, 2));
                            @endphp

                            <tr class="transition hover:bg-slate-50">

                                {{-- User --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                                            {{ $initials }}
                                        </div>

                                        <div>

                                            <div class="font-semibold text-slate-900">
                                                {{ $user?->name ?? 'Unknown User' }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-600">
                                    {{ $user?->email ?? 'N/A' }}
                                </td>


                                {{-- Role --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                        {{ $role }}
                                    </span>

                                </td>


                                {{-- Requested --}}
                                <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-600">
                                    {{ $resetRequest->created_at?->format('M d, Y h:i A') ?? 'N/A' }}
                                </td>


                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Approve --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.password-reset-requests.approve', $resetRequest) }}"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700"
                                                onclick="return confirm('Approve this password reset request?')"
                                            >
                                                Approve
                                            </button>

                                        </form>


                                        {{-- Reject --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.password-reset-requests.reject', $resetRequest) }}"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                                                onclick="return confirm('Reject this password reset request?')"
                                            >
                                                Reject
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Mobile Cards --}}
            <div class="space-y-4 p-4 md:hidden">

                @foreach ($requests as $resetRequest)

                    @php
                        $user = $resetRequest->user;
                        $role = $user?->getRoleNames()->first() ?? 'Member';
                        $initials = strtoupper(substr($user?->name ?? '?', 0, 2));
                    @endphp

                    <div class="rounded-xl border border-slate-200 bg-white p-5">

                        {{-- User --}}
                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                                {{ $initials }}
                            </div>

                            <div class="min-w-0">

                                <div class="font-semibold text-slate-900">
                                    {{ $user?->name ?? 'Unknown User' }}
                                </div>

                                <div class="truncate text-sm text-slate-500">
                                    {{ $user?->email ?? 'N/A' }}
                                </div>

                            </div>

                        </div>


                        {{-- Details --}}
                        <div class="mt-5 space-y-4">

                            <div>

                                <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Role
                                </div>

                                <span class="mt-1 inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                    {{ $role }}
                                </span>

                            </div>


                            <div>

                                <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Requested
                                </div>

                                <div class="mt-1 text-sm text-slate-600">
                                    {{ $resetRequest->created_at?->format('M d, Y h:i A') ?? 'N/A' }}
                                </div>

                            </div>

                        </div>


                        {{-- Mobile Actions --}}
                        <div class="mt-5 flex gap-2 border-t border-slate-100 pt-4">

                            <form
                                method="POST"
                                action="{{ route('admin.password-reset-requests.approve', $resetRequest) }}"
                                class="flex-1"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="w-full rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-700"
                                    onclick="return confirm('Approve this password reset request?')"
                                >
                                    Approve
                                </button>

                            </form>


                            <form
                                method="POST"
                                action="{{ route('admin.password-reset-requests.reject', $resetRequest) }}"
                                class="flex-1"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="w-full rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100"
                                    onclick="return confirm('Reject this password reset request?')"
                                >
                                    Reject
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- Empty State --}}
            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 text-lg font-semibold text-slate-900">
                    No Pending Requests
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    There are currently no password reset requests waiting for approval.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection