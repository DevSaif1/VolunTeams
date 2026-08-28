@extends('layouts.app')

@section('content')

<div class="min-h-[calc(100vh-4rem)] overflow-x-hidden bg-gray-50/70">

    <div class="mx-auto w-full max-w-5xl px-4 py-7 sm:px-6 sm:py-9 lg:px-8">

        {{-- PAGE HEADER --}}
        <div class="mb-7 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div class="min-w-0">

                <div class="mb-2 flex items-center gap-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>

                    <span class="text-xs font-bold uppercase tracking-[0.16em] text-indigo-600">
                        VolunTeams
                    </span>
                </div>

                <h1 class="text-3xl font-bold tracking-tight text-gray-950 sm:text-4xl">
                    {{ __('opportunities.create_title') }}
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-600 sm:text-[15px]">
                    {{ __('opportunities.descriptions.create') }}
                </p>

            </div>

            <a
                href="{{ route('opportunities.index') }}"
                class="inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            >
                <svg
                    class="h-4 w-4 rtl:rotate-180"
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

                {{ __('opportunities.actions.back') }}
            </a>

        </div>


        {{-- VALIDATION --}}
        @if($errors->any())

            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-sm">

                <p class="text-sm font-bold text-red-800">
                    {{ __('opportunities.messages.correct_errors') }}
                </p>

                <p class="mt-1 text-xs text-red-700">
                    {{ __('opportunities.messages.review_fields') }}
                </p>

            </div>

        @endif


        <form
            action="{{ route('opportunities.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5"
        >

            @csrf


            {{-- ================================================= --}}
            {{-- BASIC INFORMATION --}}
            {{-- ================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-indigo-50/40 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                />
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-base font-bold text-gray-900">
                                {{ __('opportunities.sections.basic_information') }}
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ __('opportunities.descriptions.create') }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5 sm:p-6">

                    {{-- TITLE --}}
                    <div>

                        <label
                            for="title"
                            class="mb-2 block text-sm font-semibold text-gray-800"
                        >
                            {{ __('opportunities.fields.title') }}

                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            required
                            maxlength="150"
                            placeholder="{{ __('opportunities.placeholders.title') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 @error('title') border-red-300 @enderror"
                        >

                        @error('title')
                            <p class="mt-2 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- TEAM / TYPE --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>

                            <label
                                for="team_id"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.team') }}

                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="team_id"
                                id="team_id"
                                required
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                                <option value="" disabled {{ old('team_id') ? '' : 'selected' }}>
                                    {{ __('opportunities.placeholders.select_team') }}
                                </option>

                                @foreach($teams as $team)

                                    <option
                                        value="{{ $team->id }}"
                                        {{ old('team_id') == $team->id ? 'selected' : '' }}
                                    >
                                        {{ $team->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('team_id')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label
                                for="type"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.type') }}

                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="type"
                                id="type"
                                required
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>
                                    {{ __('opportunities.placeholders.select_type') }}
                                </option>

                                <option value="onsite" {{ old('type') == 'onsite' ? 'selected' : '' }}>
                                    {{ __('opportunities.types.onsite') }}
                                </option>

                                <option value="remote" {{ old('type') == 'remote' ? 'selected' : '' }}>
                                    {{ __('opportunities.types.remote') }}
                                </option>

                                <option value="hybrid" {{ old('type') == 'hybrid' ? 'selected' : '' }}>
                                    {{ __('opportunities.types.hybrid') }}
                                </option>

                            </select>

                            @error('type')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>


                    {{-- STATUS / LOCATION --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>

                            <label
                                for="status"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.status') }}

                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                                <option value="" disabled {{ old('status') ? '' : 'selected' }}>
                                    {{ __('opportunities.placeholders.select_status') }}
                                </option>

                                @foreach(['draft', 'published', 'closed', 'completed', 'cancelled'] as $status)

                                    <option
                                        value="{{ $status }}"
                                        {{ old('status') == $status ? 'selected' : '' }}
                                    >
                                        {{ __('opportunities.statuses.' . $status) }}
                                    </option>

                                @endforeach

                            </select>

                            @error('status')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label
                                for="location"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.location') }}
                            </label>

                            <input
                                type="text"
                                name="location"
                                id="location"
                                value="{{ old('location') }}"
                                maxlength="255"
                                placeholder="{{ __('opportunities.placeholders.location') }}"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none placeholder:text-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                            @error('location')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- SCHEDULE --}}
            {{-- ================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/70 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-base font-bold text-gray-900">
                                {{ __('opportunities.sections.schedule_capacity') }}
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ __('opportunities.fields.start_date') }} /
                                {{ __('opportunities.fields.end_date') }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5 sm:p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                        <div>

                            <label
                                for="start_date"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.start_date') }}
                            </label>

                            <input
                                type="datetime-local"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date') }}"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-3.5 py-3 text-sm shadow-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                            @error('start_date')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label
                                for="end_date"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.end_date') }}
                            </label>

                            <input
                                type="datetime-local"
                                name="end_date"
                                id="end_date"
                                value="{{ old('end_date') }}"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-3.5 py-3 text-sm shadow-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                            @error('end_date')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label
                                for="application_deadline"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.application_deadline') }}
                            </label>

                            <input
                                type="datetime-local"
                                name="application_deadline"
                                id="application_deadline"
                                value="{{ old('application_deadline') }}"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-3.5 py-3 text-sm shadow-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                            @error('application_deadline')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>

                            <label
                                for="required_volunteers"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.required_volunteers') }}
                            </label>

                            <input
                                type="number"
                                name="required_volunteers"
                                id="required_volunteers"
                                value="{{ old('required_volunteers') }}"
                                min="1"
                                placeholder="{{ __('opportunities.placeholders.required_volunteers') }}"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm outline-none placeholder:text-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                            @error('required_volunteers')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label
                                for="hours"
                                class="mb-2 block text-sm font-semibold text-gray-800"
                            >
                                {{ __('opportunities.fields.hours') }}
                            </label>

                            <input
                                type="number"
                                name="hours"
                                id="hours"
                                value="{{ old('hours') }}"
                                step="0.01"
                                min="0.01"
                                placeholder="{{ __('opportunities.placeholders.hours') }}"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm outline-none placeholder:text-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                            @error('hours')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- DESCRIPTION & MEDIA --}}
            {{-- ================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/70 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
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

                            <h2 class="text-base font-bold text-gray-900">
                                {{ __('opportunities.sections.description_media') }}
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ __('opportunities.fields.description') }}
                                /
                                {{ __('opportunities.fields.image') }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-6 p-5 sm:p-6">

                    <div>

                        <label
                            for="description"
                            class="mb-2 block text-sm font-semibold text-gray-800"
                        >
                            {{ __('opportunities.fields.description') }}

                            <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            required
                            placeholder="{{ __('opportunities.placeholders.description') }}"
                            class="block w-full resize-y rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm leading-6 shadow-sm outline-none placeholder:text-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror

                    </div>


                    <div>

                        <label
                            for="image_path"
                            class="mb-2 block text-sm font-semibold text-gray-800"
                        >
                            {{ __('opportunities.fields.image') }}
                        </label>

                        <label
                            for="image_path"
                            class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50/60 px-6 py-9 text-center transition hover:border-indigo-400 hover:bg-indigo-50/40"
                        >

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-indigo-600 shadow-sm ring-1 ring-gray-200">

                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-9-5h.01M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>

                            </div>

                            <span class="mt-4 text-sm font-semibold text-indigo-600">
                                {{ __('opportunities.upload.upload_file') }}
                            </span>

                            <span class="mt-1 text-xs text-gray-500">
                                {{ __('opportunities.upload.file_types') }}
                            </span>

                            <input
                                id="image_path"
                                name="image_path"
                                type="file"
                                accept="image/jpeg,image/png,image/webp"
                                class="sr-only"
                            >

                        </label>

                        @error('image_path')
                            <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- ACTIVE --}}
            {{-- ================================================= --}}

            <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">

                <div class="flex items-center justify-between gap-4">

                    <div class="flex min-w-0 items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 12l5 5L20 7"
                                />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <h2 class="text-sm font-bold text-gray-900">
                                {{ __('opportunities.fields.is_active') }}
                            </h2>

                            <p class="mt-0.5 text-xs leading-5 text-gray-500">
                                {{ __('opportunities.messages.active_help') }}
                            </p>

                        </div>

                    </div>


                    <div class="shrink-0">

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
                            {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                            class="h-5 w-5 rounded-md border-gray-300 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >

                    </div>

                </div>

                @error('is_active')
                    <p class="mt-3 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror

            </section>


            {{-- ACTIONS --}}
            <div class="flex flex-col-reverse gap-3 pt-1 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('opportunities.index') }}"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 sm:w-auto"
                >
                    {{ __('opportunities.actions.cancel') }}
                </a>

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                >

                    {{ __('opportunities.actions.save') }}

                    <svg
                        class="h-4 w-4 rtl:rotate-180"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
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