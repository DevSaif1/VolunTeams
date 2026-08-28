@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold tracking-[0.18em] text-indigo-600 uppercase">
                    VOLUNTEAMS
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-950">
                {{ __('teams.edit.title') }}
            </h1>

            <p class="mt-2 text-sm sm:text-base text-gray-600">
                {{ __('teams.edit.description', ['name' => $team->name]) }}
            </p>
        </div>

        <a href="{{ route('teams.index') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                  rounded-xl border border-gray-300 bg-white
                  text-sm font-semibold text-gray-700
                  hover:bg-gray-50 hover:border-gray-400
                  transition shadow-sm">

            <span>←</span>

            {{ __('teams.edit.back_to_teams') }}

        </a>

    </div>


    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

        {{-- User / Team Header --}}
        <div class="px-6 sm:px-8 py-6 bg-gradient-to-r from-indigo-50/70 to-white border-b border-gray-200">

            <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                {{-- Logo --}}
                @if($team->logo_path)

                    <img
                        src="{{ asset('storage/' . $team->logo_path) }}"
                        alt="{{ $team->name }}"
                        class="h-16 w-16 rounded-2xl object-cover border border-gray-200 shadow-sm"
                    >

                @else

                    <div class="h-16 w-16 rounded-2xl bg-indigo-100
                                flex items-center justify-center
                                text-lg font-bold text-indigo-700
                                border border-indigo-200">

                        {{ strtoupper(substr($team->name, 0, 2)) }}

                    </div>

                @endif


                {{-- Team Information --}}
                <div class="flex-1">

                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $team->name }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $team->email ?? __('teams.not_available') }}
                    </p>

                </div>


                {{-- Current Status --}}
                @if($team->is_active)

                    <span class="inline-flex items-center gap-2 px-3 py-1.5
                                 rounded-full text-xs font-semibold
                                 bg-emerald-50 text-emerald-700
                                 border border-emerald-200">

                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                        {{ __('teams.active') }}

                    </span>

                @else

                    <span class="inline-flex items-center gap-2 px-3 py-1.5
                                 rounded-full text-xs font-semibold
                                 bg-red-50 text-red-700
                                 border border-red-200">

                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                        {{ __('teams.inactive') }}

                    </span>

                @endif

            </div>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl
                        bg-red-50 border border-red-200">

                <div class="flex gap-3">

                    <div class="shrink-0 text-red-500">
                        !
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-red-800">
                            {{ __('validation.required') ?? 'Please check the form for errors.' }}
                        </p>

                        <ul class="mt-2 text-sm text-red-700 space-y-1">

                            @foreach($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- Form --}}
        <form
            action="{{ route('teams.update', $team) }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-6 sm:p-8 space-y-8"
        >

            @csrf
            @method('PUT')


            {{-- Basic Information --}}
            <section class="rounded-2xl border border-gray-200 overflow-hidden">

                <div class="px-5 sm:px-6 py-4
                            bg-gradient-to-r from-indigo-50/60 to-white
                            border-b border-gray-200">

                    <div class="flex items-center gap-3">

                        <div class="h-9 w-9 rounded-xl bg-indigo-100
                                    flex items-center justify-center
                                    text-indigo-600">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-gray-900">
                                {{ __('teams.edit.title') }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ __('teams.edit.description', ['name' => $team->name]) }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-6 space-y-6">

                    {{-- Team Name --}}
                    <div>

                        <label for="name"
                               class="block text-sm font-semibold text-gray-700">

                            {{ __('teams.edit.team_name') }}

                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $team->name) }}"
                            required
                            maxlength="150"
                            placeholder="{{ __('teams.edit.team_name_placeholder') }}"
                            class="mt-2 block w-full rounded-xl
                                   border-gray-300
                                   focus:border-indigo-500
                                   focus:ring-indigo-500
                                   text-sm
                                   @error('name')
                                       border-red-300
                                       focus:border-red-500
                                       focus:ring-red-500
                                   @enderror"
                        >

                        @error('name')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Manager --}}
                    <div>

                        <label for="manager_id"
                               class="block text-sm font-semibold text-gray-700">

                            {{ __('teams.edit.team_manager') }}

                            <span class="text-red-500">*</span>

                        </label>

                        <select
                            name="manager_id"
                            id="manager_id"
                            required
                            class="mt-2 block w-full rounded-xl
                                   border-gray-300
                                   focus:border-indigo-500
                                   focus:ring-indigo-500
                                   text-sm
                                   @error('manager_id')
                                       border-red-300
                                       focus:border-red-500
                                       focus:ring-red-500
                                   @enderror"
                        >

                            <option value="" disabled>
                                {{ __('teams.edit.select_manager') }}
                            </option>

                            @foreach($managers as $manager)

                                <option
                                    value="{{ $manager->id }}"
                                    {{ old('manager_id', $team->manager_id) == $manager->id ? 'selected' : '' }}
                                >
                                    {{ $manager->name }} ({{ $manager->email }})
                                </option>

                            @endforeach

                        </select>

                        @error('manager_id')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Email + Phone --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Email --}}
                        <div>

                            <label for="email"
                                   class="block text-sm font-semibold text-gray-700">

                                {{ __('teams.edit.team_email') }}

                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $team->email) }}"
                                maxlength="150"
                                placeholder="{{ __('teams.edit.team_email_placeholder') }}"
                                class="mt-2 block w-full rounded-xl
                                       border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       text-sm
                                       @error('email')
                                           border-red-300
                                           focus:border-red-500
                                           focus:ring-red-500
                                       @enderror"
                            >

                            @error('email')
                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Phone --}}
                        <div>

                            <label for="phone"
                                   class="block text-sm font-semibold text-gray-700">

                                {{ __('teams.edit.phone_number') }}

                            </label>

                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone', $team->phone) }}"
                                maxlength="25"
                                placeholder="{{ __('teams.edit.phone_placeholder') }}"
                                class="mt-2 block w-full rounded-xl
                                       border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       text-sm
                                       @error('phone')
                                           border-red-300
                                           focus:border-red-500
                                           focus:ring-red-500
                                       @enderror"
                            >

                            @error('phone')
                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Address --}}
                    <div>

                        <label for="address"
                               class="block text-sm font-semibold text-gray-700">

                            {{ __('teams.edit.address') }}

                        </label>

                        <input
                            type="text"
                            name="address"
                            id="address"
                            value="{{ old('address', $team->address) }}"
                            maxlength="255"
                            placeholder="{{ __('teams.edit.address_placeholder') }}"
                            class="mt-2 block w-full rounded-xl
                                   border-gray-300
                                   focus:border-indigo-500
                                   focus:ring-indigo-500
                                   text-sm
                                   @error('address')
                                       border-red-300
                                       focus:border-red-500
                                       focus:ring-red-500
                                   @enderror"
                        >

                        @error('address')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>


            {{-- Description & Media --}}
            <section class="rounded-2xl border border-gray-200 overflow-hidden">

                <div class="px-5 sm:px-6 py-4
                            bg-gradient-to-r from-indigo-50/60 to-white
                            border-b border-gray-200">

                    <div class="flex items-center gap-3">

                        <div class="h-9 w-9 rounded-xl bg-indigo-100
                                    flex items-center justify-center
                                    text-indigo-600">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h10"/>

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-gray-900">
                                {{ __('teams.edit.description_label') }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ __('teams.edit.description') }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-6 space-y-6">

                    {{-- Description --}}
                    <div>

                        <label for="description"
                               class="block text-sm font-semibold text-gray-700">

                            {{ __('teams.edit.description_label') }}

                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            placeholder="{{ __('teams.edit.description_placeholder') }}"
                            class="mt-2 block w-full rounded-xl
                                   border-gray-300
                                   focus:border-indigo-500
                                   focus:ring-indigo-500
                                   text-sm
                                   @error('description')
                                       border-red-300
                                       focus:border-red-500
                                       focus:ring-red-500
                                   @enderror"
                        >{{ old('description', $team->description) }}</textarea>

                        @error('description')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Current Logo --}}
                    @if($team->logo_path)

                        <div>

                            <p class="text-sm font-semibold text-gray-700 mb-3">
                                {{ __('teams.edit.team_logo') }}
                            </p>

                            <div class="flex items-center gap-4
                                        p-4 rounded-xl
                                        bg-gray-50
                                        border border-gray-200">

                                <img
                                    src="{{ asset('storage/' . $team->logo_path) }}"
                                    alt="{{ $team->name }}"
                                    class="h-16 w-16 rounded-xl object-cover
                                           border border-gray-200"
                                >

                                <div>

                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $team->name }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ __('teams.edit.upload_new_file') }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- Logo Upload --}}
                    <div>

                        <label for="logo_path"
                               class="block text-sm font-semibold text-gray-700">

                            {{ __('teams.edit.team_logo') }}

                        </label>

                        <div class="mt-2 border-2 border-dashed
                                    border-gray-300 rounded-2xl
                                    p-6 text-center
                                    hover:border-indigo-400
                                    hover:bg-indigo-50/30
                                    transition">

                            <svg class="mx-auto h-10 w-10 text-indigo-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M4 16l4.5-4.5a2 2 0 012.8 0L15 15l2-2a2 2 0 012.8 0L21 14M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                            </svg>

                            <label
                                for="logo_path"
                                class="mt-3 block cursor-pointer text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                            >
                                {{ __('teams.edit.upload_new_file') }}

                                <input
                                    id="logo_path"
                                    name="logo_path"
                                    type="file"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="sr-only"
                                >
                            </label>

                            <p class="mt-1 text-xs text-gray-500">
                                {{ __('teams.edit.logo_help') }}
                            </p>

                        </div>

                        @error('logo_path')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>


            {{-- Active Team --}}
            <section class="rounded-2xl border border-gray-200
                            bg-white p-5 sm:p-6">

                <div class="flex items-center justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="h-10 w-10 rounded-xl bg-emerald-50
                                    flex items-center justify-center
                                    text-emerald-600">

                            ✓

                        </div>

                        <div>

                            <label for="is_active"
                                   class="text-sm font-bold text-gray-900">

                                {{ __('teams.edit.active_team') }}

                            </label>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ __('teams.active') }}
                            </p>

                        </div>

                    </div>


                    <div>

                        <input type="hidden"
                               name="is_active"
                               value="0">

                        <input
                            id="is_active"
                            name="is_active"
                            type="checkbox"
                            value="1"
                            {{ old('is_active', $team->is_active) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-gray-300
                                   text-indigo-600
                                   focus:ring-indigo-500"
                        >

                    </div>

                </div>

                @error('is_active')
                    <p class="mt-2 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </section>


            {{-- Actions --}}
            <div class="flex flex-col-reverse sm:flex-row
                        items-stretch sm:items-center
                        justify-end gap-3
                        pt-5 border-t border-gray-200">

                <a
                    href="{{ route('teams.index') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5 rounded-xl
                           border border-gray-300
                           bg-white
                           text-sm font-semibold text-gray-700
                           hover:bg-gray-50
                           transition"
                >
                    {{ __('teams.edit.cancel') }}
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-6 py-2.5 rounded-xl
                           bg-indigo-600
                           hover:bg-indigo-700
                           text-white text-sm font-semibold
                           shadow-sm hover:shadow
                           transition"
                >

                    {{ __('teams.edit.update_team') }}

                    <span>→</span>

                </button>

            </div>

        </form>

    </div>

</div>

@endsection