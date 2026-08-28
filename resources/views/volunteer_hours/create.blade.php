@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

        <div>

            {{-- Brand --}}
            <div class="flex items-center gap-2 mb-3">

                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold tracking-[0.18em] text-indigo-600 uppercase">
                    VOLUNTEAMS
                </span>

            </div>

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-950 tracking-tight">
                {{ __('volunteer_hours.create.title') }}
            </h1>

            <p class="mt-2 text-sm sm:text-base text-gray-600">
                {{ __('volunteer_hours.create.description') }}
            </p>

        </div>


        {{-- Back --}}
        <a
            href="{{ route('volunteer-hours.index') }}"
            class="inline-flex items-center justify-center gap-2
                   px-5 py-2.5
                   rounded-xl
                   border border-gray-200
                   bg-white
                   text-sm font-semibold
                   text-gray-700
                   shadow-sm
                   hover:bg-gray-50
                   hover:border-gray-300
                   transition"
        >

            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                />
            </svg>

            {{ __('volunteer_hours.show.back_to_hours') }}

        </a>

    </div>


    {{-- =========================================================
        FORM CARD
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-indigo-50/70 via-white to-white">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center
                           rounded-xl bg-indigo-100 text-indigo-600"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>

                </div>


                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        {{ __('volunteer_hours.create.title') }}
                    </h2>

                    <p class="mt-0.5 text-sm text-gray-500">
                        {{ __('volunteer_hours.create.description') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            FORM
        ====================================================== --}}

        <form
            action="{{ route('volunteer-hours.store') }}"
            method="POST"
            class="p-6 sm:p-8 space-y-7"
        >

            @csrf


            {{-- =================================================
                VOLUNTEER
            ================================================== --}}

            <div>

                <label
                    for="user_id"
                    class="block text-sm font-semibold text-gray-700"
                >

                    {{ __('volunteer_hours.create.volunteer') }}

                    <span class="text-red-500">*</span>

                </label>


                <div class="mt-2">

                    <select
                        name="user_id"
                        id="user_id"
                        required
                        class="block w-full rounded-xl
                               border-gray-300
                               bg-white
                               shadow-sm
                               text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500
                               @error('user_id')
                                   border-red-300 text-red-900
                                   focus:border-red-500 focus:ring-red-500
                               @enderror"
                    >

                        <option value="">
                            {{ __('volunteer_hours.create.select_volunteer') }}
                        </option>


                        @foreach ($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('user_id') == $user->id ? 'selected' : '' }}
                            >

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


            {{-- =================================================
                OPPORTUNITY
            ================================================== --}}

            <div>

                <label
                    for="opportunity_id"
                    class="block text-sm font-semibold text-gray-700"
                >

                    {{ __('volunteer_hours.create.opportunity') }}

                    <span class="text-red-500">*</span>

                </label>


                <div class="mt-2">

                    <select
                        name="opportunity_id"
                        id="opportunity_id"
                        required
                        class="block w-full rounded-xl
                               border-gray-300
                               bg-white
                               shadow-sm
                               text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500
                               @error('opportunity_id')
                                   border-red-300 text-red-900
                                   focus:border-red-500 focus:ring-red-500
                               @enderror"
                    >

                        <option value="">
                            {{ __('volunteer_hours.create.select_opportunity') }}
                        </option>


                        @foreach ($opportunities as $opportunity)

                            <option
                                value="{{ $opportunity->id }}"
                                {{ old('opportunity_id') == $opportunity->id ? 'selected' : '' }}
                            >

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


            {{-- =================================================
                APPROVED BY
            ================================================== --}}

            <div>

                <label
                    for="approved_by"
                    class="block text-sm font-semibold text-gray-700"
                >

                    {{ __('volunteer_hours.create.approved_by') }}

                    <span class="text-red-500">*</span>

                </label>


                <div class="mt-2">

                    <select
                        name="approved_by"
                        id="approved_by"
                        required
                        class="block w-full rounded-xl
                               border-gray-300
                               bg-white
                               shadow-sm
                               text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500
                               @error('approved_by')
                                   border-red-300 text-red-900
                                   focus:border-red-500 focus:ring-red-500
                               @enderror"
                    >

                        <option value="">
                            {{ __('volunteer_hours.create.select_approver') }}
                        </option>


                        @foreach ($approvers as $approver)

                            <option
                                value="{{ $approver->id }}"
                                {{ old('approved_by') == $approver->id ? 'selected' : '' }}
                            >

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


            {{-- =================================================
                HOURS + DATE
            ================================================== --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">


                {{-- Hours --}}
                <div>

                    <label
                        for="hours"
                        class="block text-sm font-semibold text-gray-700"
                    >

                        {{ __('volunteer_hours.create.hours') }}

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
                            value="{{ old('hours') }}"
                            placeholder="{{ __('volunteer_hours.create.hours_placeholder') }}"
                            class="block w-full rounded-xl
                                   border-gray-300
                                   shadow-sm
                                   text-sm
                                   focus:border-indigo-500
                                   focus:ring-indigo-500
                                   @error('hours')
                                       border-red-300 text-red-900
                                       focus:border-red-500 focus:ring-red-500
                                   @enderror"
                        >

                    </div>


                    @error('hours')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Date --}}
                <div>

                    <label
                        for="date_logged"
                        class="block text-sm font-semibold text-gray-700"
                    >

                        {{ __('volunteer_hours.create.date_logged') }}

                        <span class="text-red-500">*</span>

                    </label>


                    <div class="mt-2">

                        <input
                            type="date"
                            name="date_logged"
                            id="date_logged"
                            required
                            value="{{ old('date_logged') }}"
                            class="block w-full rounded-xl
                                   border-gray-300
                                   shadow-sm
                                   text-sm
                                   focus:border-indigo-500
                                   focus:ring-indigo-500
                                   @error('date_logged')
                                       border-red-300 text-red-900
                                       focus:border-red-500 focus:ring-red-500
                                   @enderror"
                        >

                    </div>


                    @error('date_logged')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            {{-- =================================================
                NOTES
            ================================================== --}}

            <div>

                <label
                    for="notes"
                    class="block text-sm font-semibold text-gray-700"
                >

                    {{ __('volunteer_hours.create.notes') }}

                    <span class="text-gray-400 font-normal text-xs ms-1">
                        ({{ __('volunteer_hours.optional') }})
                    </span>

                </label>


                <div class="mt-2">

                    <textarea
                        name="notes"
                        id="notes"
                        rows="5"
                        placeholder="{{ __('volunteer_hours.create.notes_placeholder') }}"
                        class="block w-full rounded-xl
                               border-gray-300
                               shadow-sm
                               text-sm
                               resize-y
                               focus:border-indigo-500
                               focus:ring-indigo-500
                               @error('notes')
                                   border-red-300 text-red-900
                                   focus:border-red-500 focus:ring-red-500
                               @enderror"
                    >{{ old('notes') }}</textarea>

                </div>


                @error('notes')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =================================================
                ACTIONS
            ================================================== --}}

            <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3 pt-6 border-t border-gray-100">

                {{-- Cancel --}}
                <a
                    href="{{ route('volunteer-hours.index') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5
                           rounded-xl
                           border border-gray-200
                           bg-white
                           text-sm font-semibold
                           text-gray-700
                           hover:bg-gray-50
                           hover:border-gray-300
                           transition"
                >

                    {{ __('volunteer_hours.create.cancel') }}

                </a>


                {{-- Submit --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5
                           rounded-xl
                           bg-indigo-600
                           text-sm font-semibold
                           text-white
                           shadow-sm
                           hover:bg-indigo-700
                           focus:outline-none
                           focus:ring-2
                           focus:ring-indigo-500
                           focus:ring-offset-2
                           transition"
                >

                    {{ __('volunteer_hours.create.add_hours') }}

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12h14m-6-6 6 6-6 6"
                        />
                    </svg>

                </button>

            </div>

        </form>

    </div>

</div>

@endsection