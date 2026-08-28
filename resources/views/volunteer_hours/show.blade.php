@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('volunteer_hours.show.title') }}
                </h1>

                <p class="mt-2 text-sm text-gray-600">
                    {{ __('volunteer_hours.show.description') }}
                </p>
            </div>

            {{-- Header Actions --}}
            <div class="flex items-center gap-3">

                <a href="{{ route('volunteer-hours.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition">

                    ← {{ __('volunteer_hours.show.back_to_hours') }}

                </a>

                @if(auth()->user()->hasAnyRole(['Admin', 'Team Manager']))
                    <a href="{{ route('volunteer-hours.edit', $volunteerHour) }}"
                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition">

                        {{ __('volunteer_hours.show.edit_record') }} →

                    </a>
                @endif

            </div>
        </div>


        {{-- Main Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- Summary Header --}}
            <div class="p-6 sm:p-8 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

                    {{-- Volunteer --}}
                    <div class="flex items-center gap-4">

                        <div class="h-16 w-16 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center text-lg font-bold text-indigo-700">
                            {{ strtoupper(substr($volunteerHour->user?->name ?? 'UN', 0, 2)) }}
                        </div>

                        <div>

                            <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">
                                {{ __('volunteer_hours.show.volunteer') }}
                            </p>

                            <h2 class="mt-1 text-xl font-bold text-gray-900">
                                {{ $volunteerHour->user?->name ?? __('volunteer_hours.show.unknown_volunteer') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $volunteerHour->user?->email ?? __('volunteer_hours.show.no_email') }}
                            </p>

                        </div>

                    </div>


                    {{-- Hours --}}
                    <div class="text-left sm:text-right">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('volunteer_hours.show.logged_hours') }}
                        </p>

                        <span class="mt-2 inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-indigo-100 text-indigo-800">

                            ⏱
                            {{ number_format($volunteerHour->hours, 2) }}
                            {{ __('volunteer_hours.show.hours') }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- Details --}}
            <div class="p-6 sm:p-8">

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                    {{-- Opportunity --}}
                    <div class="sm:col-span-2 p-5 rounded-xl border border-gray-200 bg-white">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('volunteer_hours.show.opportunity') }}
                        </dt>

                        <dd class="mt-2 text-lg font-semibold text-indigo-600">

                            {{ $volunteerHour->opportunity?->title ?? __('volunteer_hours.show.unknown_opportunity') }}

                        </dd>

                    </div>


                    {{-- Date Logged --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('volunteer_hours.show.date_logged') }}
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-gray-900">

                            {{ $volunteerHour->date_logged
                                ? \Carbon\Carbon::parse($volunteerHour->date_logged)->format('M d, Y')
                                : __('volunteer_hours.show.not_available')
                            }}

                        </dd>

                    </div>


                    {{-- Approved By --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('volunteer_hours.show.approved_by') }}
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-gray-900">

                            {{ $volunteerHour->approver?->name ?? __('volunteer_hours.show.not_available') }}

                            @if($volunteerHour->approver?->email)

                                <span class="block mt-1 text-xs text-gray-500">
                                    {{ $volunteerHour->approver->email }}
                                </span>

                            @endif

                        </dd>

                    </div>


                    {{-- Notes --}}
                    <div class="sm:col-span-2 p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('volunteer_hours.show.notes') }}
                        </dt>

                        <dd class="mt-3 text-sm text-gray-900 bg-gray-50 p-5 rounded-lg border border-gray-100 whitespace-pre-line">

                            {{ !empty($volunteerHour->notes)
                                ? $volunteerHour->notes
                                : __('volunteer_hours.show.no_notes')
                            }}

                        </dd>

                    </div>


                    {{-- Created At --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('volunteer_hours.show.record_created_at') }}
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-gray-900">

                            {{ $volunteerHour->created_at
                                ? $volunteerHour->created_at->format('M d, Y h:i A')
                                : __('volunteer_hours.show.not_available')
                            }}

                        </dd>

                    </div>


                    {{-- Updated At --}}
                    <div class="p-5 rounded-xl border border-gray-200">

                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('volunteer_hours.show.last_updated_at') }}
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-gray-900">

                            {{ $volunteerHour->updated_at
                                ? $volunteerHour->updated_at->format('M d, Y h:i A')
                                : __('volunteer_hours.show.not_available')
                            }}

                        </dd>

                    </div>

                </dl>

            </div>

        </div>

    </div>
@endsection