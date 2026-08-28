@extends('layouts.app')

@section('content')

<div class="min-h-[calc(100vh-4rem)] overflow-x-hidden bg-gray-50/70">

    <div class="mx-auto w-full max-w-6xl px-4 py-7 sm:px-6 sm:py-9 lg:px-8">

        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div class="mb-7">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div class="min-w-0">

                    <div class="mb-2 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.16em] text-indigo-600">
                            VolunTeams
                        </span>

                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-gray-950 sm:text-4xl">
                        {{ __('opportunities.edit_title') }}
                    </h1>

                    <p class="mt-2 max-w-3xl text-sm leading-6 text-gray-600 sm:text-[15px]">
                        {{ __('opportunities.descriptions.edit', ['title' => $opportunity->title]) }}
                    </p>

                </div>


                <div class="flex w-full sm:w-auto">

                    <a
                        href="{{ route('opportunities.show', $opportunity) }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >

                        <svg
                            class="h-4 w-4 rtl:rotate-180"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>

                        {{ __('opportunities.actions.back') }}

                    </a>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- VALIDATION SUMMARY --}}
        {{-- ========================================================= --}}

        @if($errors->any())

            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-sm">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.72 3h17.62a2 2 0 003.44 0l-8.82-15a2 2 0 00-3.44 0z"
                            />
                        </svg>

                    </div>


                    <div>

                        <p class="text-sm font-bold text-red-800">
                            {{ __('opportunities.misc.validation_error') }}
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


        {{-- ========================================================= --}}
        {{-- MAIN FORM --}}
        {{-- ========================================================= --}}

        <form
            action="{{ route('opportunities.update', $opportunity) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5"
        >

            @csrf
            @method('PUT')


            {{-- ===================================================== --}}
            {{-- BASIC INFORMATION --}}
            {{-- ===================================================== --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50/60 via-white to-white px-5 py-4 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M13 16h-1v-4h-1m1-8a9 9 0 100 18 9 9 0 000-18z"
                                />
                            </svg>

                        </div>


                        <div>

                            <h2 class="text-sm font-bold text-gray-900">
                                {{ __('opportunities.sections.basic_information') }}
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ __('opportunities.sections.basic_information_description') }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5 sm:p-6">


                    {{-- Title --}}
                    <div>

                        <label
                            for="title"
                            class="block text-xs font-bold text-gray-700"
                        >
                            {{ __('opportunities.fields.title') }}
                            <span class="text-red-500">*</span>
                        </label>


                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $opportunity->title) }}"
                            required
                            maxlength="150"
                            placeholder="{{ __('opportunities.placeholders.title') }}"
                            class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('title') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        >

                        @error('title')
                            <p class="mt-2 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Team / Type --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- Team --}}
                        <div>

                            <label
                                for="team_id"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.team') }}
                                <span class="text-red-500">*</span>
                            </label>


                            <select
                                name="team_id"
                                id="team_id"
                                required
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('team_id') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >

                                <option value="" disabled>
                                    {{ __('opportunities.placeholders.select_team') }}
                                </option>

                                @foreach($teams as $team)

                                    <option
                                        value="{{ $team->id }}"
                                        {{ old('team_id', $opportunity->team_id) == $team->id ? 'selected' : '' }}
                                    >
                                        {{ $team->name }}
                                    </option>

                                @endforeach

                            </select>


                            @error('team_id')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Type --}}
                        <div>

                            <label
                                for="type"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.type') }}
                                <span class="text-red-500">*</span>
                            </label>


                            <select
                                name="type"
                                id="type"
                                required
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('type') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >

                                <option value="" disabled>
                                    {{ __('opportunities.placeholders.select_type') }}
                                </option>

                                <option
                                    value="onsite"
                                    {{ old('type', $opportunity->type) == 'onsite' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.types.onsite') }}
                                </option>

                                <option
                                    value="remote"
                                    {{ old('type', $opportunity->type) == 'remote' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.types.remote') }}
                                </option>

                                <option
                                    value="hybrid"
                                    {{ old('type', $opportunity->type) == 'hybrid' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.types.hybrid') }}
                                </option>

                            </select>


                            @error('type')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Status / Location --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.status') }}
                                <span class="text-red-500">*</span>
                            </label>


                            <select
                                name="status"
                                id="status"
                                required
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('status') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >

                                <option value="" disabled>
                                    {{ __('opportunities.placeholders.select_status') }}
                                </option>

                                <option
                                    value="draft"
                                    {{ old('status', $opportunity->status) == 'draft' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.statuses.draft') }}
                                </option>

                                <option
                                    value="published"
                                    {{ old('status', $opportunity->status) == 'published' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.statuses.published') }}
                                </option>

                                <option
                                    value="closed"
                                    {{ old('status', $opportunity->status) == 'closed' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.statuses.closed') }}
                                </option>

                                <option
                                    value="completed"
                                    {{ old('status', $opportunity->status) == 'completed' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.statuses.completed') }}
                                </option>

                                <option
                                    value="cancelled"
                                    {{ old('status', $opportunity->status) == 'cancelled' ? 'selected' : '' }}
                                >
                                    {{ __('opportunities.statuses.cancelled') }}
                                </option>

                            </select>


                            @error('status')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Location --}}
                        <div>

                            <label
                                for="location"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.location') }}
                            </label>


                            <input
                                type="text"
                                name="location"
                                id="location"
                                value="{{ old('location', $opportunity->location) }}"
                                maxlength="255"
                                placeholder="{{ __('opportunities.placeholders.location') }}"
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('location') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >


                            @error('location')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </section>


            {{-- ===================================================== --}}
            {{-- SCHEDULE & CAPACITY --}}
            {{-- ===================================================== --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50/60 via-white to-white px-5 py-4 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <rect
                                    width="18"
                                    height="18"
                                    x="3"
                                    y="4"
                                    rx="2"
                                    ry="2"
                                    stroke-width="1.8"
                                />
                                <path
                                    stroke-width="1.8"
                                    d="M16 2v4M8 2v4M3 10h18"
                                />
                            </svg>

                        </div>


                        <div>

                            <h2 class="text-sm font-bold text-gray-900">
                                {{ __('opportunities.sections.schedule_capacity') }}
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ __('opportunities.sections.schedule_capacity_description') }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5 sm:p-6">


                    {{-- Dates --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


                        {{-- Start --}}
                        <div>

                            <label
                                for="start_date"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.start_date') }}
                            </label>


                            <input
                                type="datetime-local"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date', $opportunity->start_date ? \Carbon\Carbon::parse($opportunity->start_date)->format('Y-m-d\TH:i') : '') }}"
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('start_date') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >


                            @error('start_date')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- End --}}
                        <div>

                            <label
                                for="end_date"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.end_date') }}
                            </label>


                            <input
                                type="datetime-local"
                                name="end_date"
                                id="end_date"
                                value="{{ old('end_date', $opportunity->end_date ? \Carbon\Carbon::parse($opportunity->end_date)->format('Y-m-d\TH:i') : '') }}"
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('end_date') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >


                            @error('end_date')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Deadline --}}
                        <div>

                            <label
                                for="application_deadline"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.application_deadline') }}
                            </label>


                            <input
                                type="datetime-local"
                                name="application_deadline"
                                id="application_deadline"
                                value="{{ old('application_deadline', $opportunity->application_deadline ? \Carbon\Carbon::parse($opportunity->application_deadline)->format('Y-m-d\TH:i') : '') }}"
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('application_deadline') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >


                            @error('application_deadline')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Capacity --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- Volunteers --}}
                        <div>

                            <label
                                for="required_volunteers"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.required_volunteers') }}
                            </label>


                            <input
                                type="number"
                                name="required_volunteers"
                                id="required_volunteers"
                                value="{{ old('required_volunteers', $opportunity->required_volunteers) }}"
                                min="1"
                                placeholder="{{ __('opportunities.placeholders.required_volunteers') }}"
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('required_volunteers') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >


                            @error('required_volunteers')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Hours --}}
                        <div>

                            <label
                                for="hours"
                                class="block text-xs font-bold text-gray-700"
                            >
                                {{ __('opportunities.fields.hours') }}
                            </label>


                            <input
                                type="number"
                                name="hours"
                                id="hours"
                                value="{{ old('hours', $opportunity->hours) }}"
                                step="0.01"
                                min="0.01"
                                placeholder="{{ __('opportunities.placeholders.hours') }}"
                                class="mt-2 block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('hours') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                            >


                            @error('hours')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </section>


            {{-- ===================================================== --}}
            {{-- DESCRIPTION & MEDIA --}}
            {{-- ===================================================== --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50/60 via-white to-white px-5 py-4 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M7 8h10M7 12h10M7 16h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"
                                />
                            </svg>

                        </div>


                        <div>

                            <h2 class="text-sm font-bold text-gray-900">
                                {{ __('opportunities.sections.description_media') }}
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ __('opportunities.sections.description_media_description') }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5 sm:p-6">


                    {{-- Description --}}
                    <div>

                        <label
                            for="description"
                            class="block text-xs font-bold text-gray-700"
                        >
                            {{ __('opportunities.fields.description') }}
                            <span class="text-red-500">*</span>
                        </label>


                        <textarea
                            name="description"
                            id="description"
                            rows="7"
                            required
                            placeholder="{{ __('opportunities.placeholders.description') }}"
                            class="mt-2 block w-full resize-y rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm leading-6 text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('description') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        >{{ old('description', $opportunity->description) }}</textarea>


                        @error('description')
                            <p class="mt-2 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Current Image --}}
                    @if($opportunity->image_path)

                        <div>

                            <p class="mb-2 text-xs font-bold text-gray-700">
                                {{ __('opportunities.upload.current_image') }}
                            </p>


                            <div class="flex items-center gap-4 rounded-2xl border border-gray-200 bg-gray-50 p-4">

                                <img
                                    src="{{ asset('storage/' . $opportunity->image_path) }}"
                                    alt="{{ $opportunity->title }}"
                                    class="h-20 w-20 shrink-0 rounded-xl object-cover shadow-sm ring-1 ring-gray-200"
                                >


                                <div class="min-w-0">

                                    <p class="text-sm font-bold text-gray-900">
                                        {{ __('opportunities.upload.replace_image') }}
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        {{ __('opportunities.upload.file_types') }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- Upload --}}
                    <div>

                        <label
                            for="image_path"
                            class="block text-xs font-bold text-gray-700"
                        >
                            {{ __('opportunities.fields.image') }}
                        </label>


                        <div class="mt-2 rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50/50 p-6 transition hover:border-indigo-400 hover:bg-indigo-50/20">

                            <div class="text-center">

                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-white text-indigo-500 shadow-sm ring-1 ring-gray-200">

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M4 16l4.5-4.5a2 2 0 012.8 0L15 15l2-2a2 2 0 012.8 0L20 13m-2-8H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7.5L17.5 5H18z"
                                        />
                                    </svg>

                                </div>


                                <label
                                    for="image_path"
                                    class="mt-3 inline-flex cursor-pointer items-center gap-2 rounded-lg px-3 py-2 text-sm font-bold text-indigo-600 transition hover:bg-indigo-50"
                                >

                                    {{ __('opportunities.upload.upload_new_file') }}

                                    <input
                                        id="image_path"
                                        name="image_path"
                                        type="file"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="sr-only"
                                    >

                                </label>


                                <p class="text-xs text-gray-500">
                                    {{ __('opportunities.upload.file_types') }}
                                </p>

                            </div>

                        </div>


                        @error('image_path')
                            <p class="mt-2 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>


            {{-- ===================================================== --}}
            {{-- ACTIVE STATUS --}}
            {{-- ===================================================== --}}

            <section class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 12l4 4L19 6"
                                />
                            </svg>

                        </div>


                        <div>

                            <label
                                for="is_active"
                                class="block text-sm font-bold text-gray-900"
                            >
                                {{ __('opportunities.fields.is_active') }}
                            </label>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ __('opportunities.misc.active_description') }}
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center">

                        <input
                            type="hidden"
                            name="is_active"
                            value="0"
                        >


                        <input
                            id="is_active"
                            name="is_active"
                            type="checkbox"
                            value="1"
                            {{ old('is_active', $opportunity->is_active) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500"
                        >

                    </div>

                </div>


                @error('is_active')

                    <div class="border-t border-red-100 bg-red-50 px-5 py-3 sm:px-6">

                        <p class="text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>

                    </div>

                @enderror

            </section>


            {{-- ===================================================== --}}
            {{-- ACTIONS --}}
            {{-- ===================================================== --}}

            <div class="flex flex-col-reverse gap-3 pt-1 sm:flex-row sm:items-center sm:justify-end">

                <a
                    href="{{ route('opportunities.show', $opportunity) }}"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                >
                    {{ __('opportunities.actions.cancel') }}
                </a>


                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                >

                    {{ __('opportunities.actions.update') }}

                    <svg
                        class="h-4 w-4 rtl:rotate-180"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12h14m-7-7l7 7-7 7"
                        />
                    </svg>

                </button>

            </div>

        </form>

    </div>

</div>

@endsection