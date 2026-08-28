@extends('layouts.app')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('volunteer_hours.edit.title') }}
                </h1>

                <p class="mt-2 text-sm text-gray-600">
                    {{ __('volunteer_hours.edit.description') }}
                </p>
            </div>

            <a href="{{ route('volunteer-hours.index') }}"
               class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition">

                ← {{ __('volunteer_hours.edit.back_to_hours') }}

            </a>

        </div>


        {{-- Form Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <form action="{{ route('volunteer-hours.update', $volunteerHour) }}"
                  method="POST"
                  class="p-6 sm:p-8 space-y-6">

                @csrf
                @method('PUT')


                {{-- Volunteer --}}
                <div>

                    <label for="user_id"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('volunteer_hours.edit.volunteer') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <div class="mt-2">

                        <select
                            name="user_id"
                            id="user_id"
                            required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('user_id') border-red-300 text-red-900 @enderror">

                            <option value="">
                                {{ __('volunteer_hours.edit.select_volunteer') }}
                            </option>

                            @foreach ($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    {{ old('user_id', $volunteerHour->user_id) == $user->id ? 'selected' : '' }}>

                                    {{ $user->name }} ({{ $user->email }})

                                </option>

                            @endforeach

                        </select>

                    </div>

                    @error('user_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Opportunity --}}
                <div>

                    <label for="opportunity_id"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('volunteer_hours.edit.opportunity') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <div class="mt-2">

                        <select
                            name="opportunity_id"
                            id="opportunity_id"
                            required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('opportunity_id') border-red-300 text-red-900 @enderror">

                            <option value="">
                                {{ __('volunteer_hours.edit.select_opportunity') }}
                            </option>

                            @foreach ($opportunities as $opportunity)

                                <option
                                    value="{{ $opportunity->id }}"
                                    {{ old('opportunity_id', $volunteerHour->opportunity_id) == $opportunity->id ? 'selected' : '' }}>

                                    {{ $opportunity->title }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    @error('opportunity_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Approved By --}}
                <div>

                    <label for="approved_by"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('volunteer_hours.edit.approved_by') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <div class="mt-2">

                        <select
                            name="approved_by"
                            id="approved_by"
                            required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('approved_by') border-red-300 text-red-900 @enderror">

                            <option value="">
                                {{ __('volunteer_hours.edit.select_approver') }}
                            </option>

                            @foreach ($approvers as $approver)

                                <option
                                    value="{{ $approver->id }}"
                                    {{ old('approved_by', $volunteerHour->approved_by) == $approver->id ? 'selected' : '' }}>

                                    {{ $approver->name }} ({{ $approver->email }})

                                </option>

                            @endforeach

                        </select>

                    </div>

                    @error('approved_by')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Hours + Date --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">


                    {{-- Hours --}}
                    <div>

                        <label for="hours"
                               class="block text-sm font-medium text-gray-700">

                            {{ __('volunteer_hours.edit.hours') }}

                            <span class="text-red-500">*</span>

                        </label>

                        <div class="mt-2">

                            <input
                                type="number"
                                name="hours"
                                id="hours"
                                min="0.25"
                                max="999.99"
                                step="0.25"
                                required
                                value="{{ old('hours', $volunteerHour->hours) }}"
                                placeholder="{{ __('volunteer_hours.edit.hours_placeholder') }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('hours') border-red-300 text-red-900 @enderror">

                        </div>

                        @error('hours')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Date Logged --}}
                    <div>

                        <label for="date_logged"
                               class="block text-sm font-medium text-gray-700">

                            {{ __('volunteer_hours.edit.date_logged') }}

                            <span class="text-red-500">*</span>

                        </label>

                        <div class="mt-2">

                            @php
                                $formattedDateLogged = old(
                                    'date_logged',
                                    $volunteerHour->date_logged
                                        ? \Carbon\Carbon::parse($volunteerHour->date_logged)->format('Y-m-d')
                                        : ''
                                );
                            @endphp

                            <input
                                type="date"
                                name="date_logged"
                                id="date_logged"
                                required
                                value="{{ $formattedDateLogged }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date_logged') border-red-300 text-red-900 @enderror">

                        </div>

                        @error('date_logged')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- Notes --}}
                <div>

                    <label for="notes"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('volunteer_hours.edit.notes') }}

                        <span class="ml-1 text-xs font-normal text-gray-400">
                            ({{ __('volunteer_hours.edit.optional') }})
                        </span>

                    </label>

                    <div class="mt-2">

                        <textarea
                            name="notes"
                            id="notes"
                            rows="5"
                            placeholder="{{ __('volunteer_hours.edit.notes_placeholder') }}"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('notes') border-red-300 text-red-900 @enderror">{{ old('notes', $volunteerHour->notes) }}</textarea>

                    </div>

                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">

                    <a href="{{ route('volunteer-hours.show', $volunteerHour) }}"
                       class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">

                        {{ __('volunteer_hours.edit.cancel') }}

                    </a>

                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition">

                        {{ __('volunteer_hours.edit.update_hours') }}

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection