@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold tracking-[0.18em] text-indigo-600 uppercase">
                    VOLUNTEAMS
                </span>
            </div>

            <h1 class="text-3xl font-bold text-gray-950">
                {{ __('applications.create.title') }}
            </h1>

            <p class="mt-2 text-sm text-gray-600">
                {{ __('applications.create.description') }}
            </p>
        </div>


        <a
            href="{{ route('applications.index') }}"
            class="inline-flex items-center justify-center gap-2
                   px-5 py-2.5
                   border border-gray-200
                   rounded-xl
                   bg-white
                   hover:bg-gray-50
                   text-sm font-semibold text-gray-700
                   shadow-sm
                   transition"
        >
            <span>
                {{ app()->getLocale() === 'ar' ? '→' : '←' }}
            </span>

            {{ __('applications.create.back_to_applications') }}
        </a>

    </div>


    {{-- Form Container --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <form
            action="{{ route('applications.store') }}"
            method="POST"
        >

            @csrf


            {{-- Before You Submit --}}
            <div class="p-6 sm:p-8 border-b border-gray-200">

                <div class="p-5 bg-indigo-50 border border-indigo-100 rounded-xl">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-700">
                            !
                        </div>

                        <div>

                            <p class="text-sm font-bold text-indigo-900">
                                {{ __('applications.create.before_you_submit') }}
                            </p>

                            <ul class="mt-2 text-xs text-indigo-700 space-y-2">

                                <li>
                                    • {{ __('applications.create.account_used_automatically') }}
                                </li>

                                <li>
                                    • {{ __('applications.create.selected_opportunity') }}
                                </li>

                                <li>
                                    • {{ __('applications.create.explain_reason') }}
                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Application Information --}}
            <div class="p-6 sm:p-8 space-y-6">


                {{-- Current Volunteer --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700">
                        {{ __('applications.create.volunteer') }}
                    </label>

                    <div class="mt-2 p-4 bg-gray-50 border border-gray-200 rounded-xl">

                        <p class="text-sm font-semibold text-gray-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>


                {{-- Opportunity --}}
                <div>

                    <label
                        for="opportunity_id"
                        class="block text-sm font-semibold text-gray-700"
                    >

                        {{ __('applications.create.opportunity') }}

                        <span class="text-red-500">*</span>

                    </label>


                    <select
                        name="opportunity_id"
                        id="opportunity_id"
                        required
                        class="mt-2 block w-full rounded-xl
                               border-gray-300
                               shadow-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500
                               sm:text-sm
                               @error('opportunity_id')
                                   border-red-300 text-red-900
                               @enderror"
                    >

                        <option value="" disabled
                            {{ old('opportunity_id', $selectedOpportunityId) ? '' : 'selected' }}
                        >
                            {{ __('applications.create.select_opportunity') }}
                        </option>


                        @foreach($opportunities as $opportunity)

                            <option
                                value="{{ $opportunity->id }}"
                                {{ old('opportunity_id', $selectedOpportunityId) == $opportunity->id ? 'selected' : '' }}
                            >

                                {{ $opportunity->title }}

                            </option>

                        @endforeach

                    </select>


                    @error('opportunity_id')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Reason --}}
                <div>

                    <label
                        for="reason"
                        class="block text-sm font-semibold text-gray-700"
                    >

                        {{ __('applications.create.reason') }}

                        <span class="text-red-500">*</span>

                    </label>


                    <textarea
                        name="reason"
                        id="reason"
                        rows="6"
                        required
                        maxlength="1000"
                        placeholder="{{ __('applications.create.reason_placeholder') }}"
                        class="mt-2 block w-full rounded-xl
                               border-gray-300
                               shadow-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500
                               sm:text-sm
                               min-h-[140px]
                               @error('reason')
                                   border-red-300 text-red-900
                               @enderror"
                    >{{ old('reason') }}</textarea>


                    @error('reason')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3
                        px-6 py-5 sm:px-8
                        border-t border-gray-200
                        bg-gray-50/50">

                <a
                    href="{{ route('applications.index') }}"
                    class="px-5 py-2.5
                           border border-gray-300
                           rounded-xl
                           bg-white
                           hover:bg-gray-50
                           text-sm font-semibold
                           text-gray-700
                           transition"
                >
                    {{ __('applications.cancel') }}
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5
                           rounded-xl
                           bg-indigo-600
                           hover:bg-indigo-700
                           text-white
                           text-sm font-semibold
                           shadow-sm
                           transition"
                >

                    {{ __('applications.create.submit_application') }}

                    <span>
                        {{ app()->getLocale() === 'ar' ? '←' : '→' }}
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>

@endsection