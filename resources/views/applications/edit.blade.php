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
                {{ __('applications.edit.title') }}
            </h1>

            <p class="mt-2 text-sm text-gray-600">
                {{ __('applications.edit.description') }}
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

            {{ __('applications.edit.back_to_applications') }}

        </a>

    </div>


    {{-- Form Container --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <form
            action="{{ route('applications.update', $application) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Editing Guidelines --}}
            <div class="p-6 sm:p-8 border-b border-gray-200">

                <div class="p-5 bg-indigo-50 border border-indigo-100 rounded-xl">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-700">
                            !
                        </div>

                        <div>

                            <p class="text-sm font-bold text-indigo-900">
                                {{ __('applications.edit.editing_guidelines') }}
                            </p>

                            <ul class="mt-2 text-xs text-indigo-700 space-y-2">

                                <li>
                                    • {{ __('applications.edit.locked_fields') }}
                                </li>

                                <li>
                                    • {{ __('applications.edit.update_reason_or_notes') }}
                                </li>

                                <li>
                                    • {{ __('applications.edit.set_current_status') }}
                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Application Information --}}
            <div class="p-6 sm:p-8 space-y-6">


                {{-- Volunteer --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700">

                        {{ __('applications.edit.volunteer') }}

                        <span class="ml-1 text-xs font-normal text-gray-400">
                            ({{ __('applications.edit.locked') }})
                        </span>

                    </label>


                    <div class="mt-2">

                        <select
                            disabled
                            class="block w-full rounded-xl
                                   border-gray-300
                                   bg-gray-50
                                   shadow-sm
                                   text-gray-500
                                   sm:text-sm
                                   cursor-not-allowed"
                        >

                            <option>

                                {{ $application->user->name
                                    ?? __('applications.not_available') }}

                                @if(isset($application->user->email))

                                    — {{ $application->user->email }}

                                @endif

                            </option>

                        </select>

                    </div>

                </div>


                {{-- Opportunity --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700">

                        {{ __('applications.edit.opportunity') }}

                        <span class="ml-1 text-xs font-normal text-gray-400">
                            ({{ __('applications.edit.locked') }})
                        </span>

                    </label>


                    <div class="mt-2">

                        <select
                            disabled
                            class="block w-full rounded-xl
                                   border-gray-300
                                   bg-gray-50
                                   shadow-sm
                                   text-gray-500
                                   sm:text-sm
                                   cursor-not-allowed"
                        >

                            <option>

                                {{ $application->opportunity->title
                                    ?? __('applications.not_available') }}

                            </option>

                        </select>

                    </div>

                </div>


                {{-- Reason --}}
                <div>

                    <label
                        for="reason"
                        class="block text-sm font-semibold text-gray-700"
                    >

                        {{ __('applications.edit.reason') }}

                    </label>


                    <textarea
                        name="reason"
                        id="reason"
                        rows="5"
                        maxlength="1000"
                        placeholder="{{ __('applications.edit.reason_placeholder') }}"
                        class="mt-2 block w-full rounded-xl
                               border-gray-300
                               shadow-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500
                               sm:text-sm
                               min-h-[130px]
                               @error('reason')
                                   border-red-300
                                   text-red-900
                                   focus:border-red-500
                                   focus:ring-red-500
                               @enderror"
                    >{{ old('reason', $application->reason) }}</textarea>


                    @error('reason')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            {{-- Management Section --}}
            <div class="px-6 pb-6 sm:px-8 sm:pb-8">

                <div class="rounded-2xl border border-gray-200 overflow-hidden">

                    {{-- Section Header --}}
                    <div class="px-5 sm:px-6 py-5
                                bg-gradient-to-r from-indigo-50/70 to-white
                                border-b border-gray-200">

                        <h2 class="text-lg font-bold text-gray-900">
                            {{ __('applications.edit.management_controls') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('applications.edit.set_current_status') }}
                        </p>

                    </div>


                    <div class="p-5 sm:p-6 space-y-6">


                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="block text-sm font-semibold text-gray-700"
                            >

                                {{ __('applications.edit.application_status') }}

                                <span class="text-red-500">*</span>

                            </label>


                            <select
                                name="status"
                                id="status"
                                required
                                class="mt-2 block w-full rounded-xl
                                       border-gray-300
                                       shadow-sm
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       sm:text-sm
                                       @error('status')
                                           border-red-300
                                           text-red-900
                                           focus:border-red-500
                                           focus:ring-red-500
                                       @enderror"
                            >

                                <option
                                    value="pending"
                                    {{ old('status', $application->status) === 'pending' ? 'selected' : '' }}
                                >
                                    {{ __('applications.statuses.pending') }}
                                </option>


                                <option
                                    value="approved"
                                    {{ old('status', $application->status) === 'approved' ? 'selected' : '' }}
                                >
                                    {{ __('applications.statuses.approved') }}
                                </option>


                                <option
                                    value="rejected"
                                    {{ old('status', $application->status) === 'rejected' ? 'selected' : '' }}
                                >
                                    {{ __('applications.statuses.rejected') }}
                                </option>


                                <option
                                    value="attended"
                                    {{ old('status', $application->status) === 'attended' ? 'selected' : '' }}
                                >
                                    {{ __('applications.statuses.attended') }}
                                </option>


                                <option
                                    value="cancelled"
                                    {{ old('status', $application->status) === 'cancelled' ? 'selected' : '' }}
                                >
                                    {{ __('applications.statuses.cancelled') }}
                                </option>

                            </select>


                            @error('status')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Manager Notes --}}
                        <div>

                            <label
                                for="manager_notes"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                {{ __('applications.edit.manager_notes') }}
                            </label>


                            <textarea
                                name="manager_notes"
                                id="manager_notes"
                                rows="4"
                                placeholder="{{ __('applications.edit.manager_notes_placeholder') }}"
                                class="mt-2 block w-full rounded-xl
                                       border-gray-300
                                       shadow-sm
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       sm:text-sm
                                       @error('manager_notes')
                                           border-red-300
                                           text-red-900
                                           focus:border-red-500
                                           focus:ring-red-500
                                       @enderror"
                            >{{ old('manager_notes', $application->manager_notes) }}</textarea>


                            @error('manager_notes')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col-reverse sm:flex-row
                        items-stretch sm:items-center
                        justify-end gap-3
                        px-6 py-5 sm:px-8
                        border-t border-gray-200
                        bg-gray-50/50">

                <a
                    href="{{ route('applications.index') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5
                           border border-gray-300
                           rounded-xl
                           bg-white
                           hover:bg-gray-50
                           text-sm font-semibold
                           text-gray-700
                           transition"
                >
                    {{ __('applications.edit.cancel') }}
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-6 py-2.5
                           rounded-xl
                           bg-indigo-600
                           hover:bg-indigo-700
                           text-white
                           text-sm font-semibold
                           shadow-sm
                           transition"
                >

                    {{ __('applications.edit.update_application') }}

                    <span>
                        {{ app()->getLocale() === 'ar' ? '←' : '→' }}
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>

@endsection