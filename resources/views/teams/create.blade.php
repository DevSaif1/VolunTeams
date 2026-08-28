@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('teams.create.title') }}
                </h1>

                <p class="mt-2 text-sm text-gray-600">
                    {{ __('teams.create.description') }}
                </p>
            </div>

            <a href="{{ route('teams.index') }}"
               class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition">
                ← {{ __('teams.create.back_to_teams') }}
            </a>
        </div>


        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- Create Team Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <form action="{{ route('teams.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- Basic Information --}}
                <div class="p-6 sm:p-8 border-b border-gray-200">

                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                            <span class="text-indigo-600 font-bold">✓</span>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                {{ __('teams.create.title') }}
                            </h2>

                            <p class="text-xs text-gray-500">
                                {{ __('teams.create.description') }}
                            </p>
                        </div>
                    </div>


                    {{-- Team Name --}}
                    <div class="mb-6">
                        <label for="name"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('teams.create.team_name') }}
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            maxlength="150"
                            placeholder="{{ __('teams.create.team_name_placeholder') }}"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Manager --}}
                    <div class="mb-6">
                        <label for="manager_id"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('teams.create.team_manager') }}
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="manager_id"
                            id="manager_id"
                            required
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('manager_id') border-red-500 @enderror"
                        >
                            <option value="" disabled {{ old('manager_id') ? '' : 'selected' }}>
                                {{ __('teams.create.select_manager') }}
                            </option>

                            @foreach($managers as $manager)
                                <option
                                    value="{{ $manager->id }}"
                                    {{ old('manager_id') == $manager->id ? 'selected' : '' }}
                                >
                                    {{ $manager->name }} ({{ $manager->email }})
                                </option>
                            @endforeach
                        </select>

                        @error('manager_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Email + Phone --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Email --}}
                        <div>
                            <label for="email"
                                   class="block text-sm font-medium text-gray-700">
                                {{ __('teams.create.team_email') }}
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                maxlength="150"
                                placeholder="{{ __('teams.create.team_email_placeholder') }}"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                            >

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Phone --}}
                        <div>
                            <label for="phone"
                                   class="block text-sm font-medium text-gray-700">
                                {{ __('teams.create.phone_number') }}
                            </label>

                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone') }}"
                                maxlength="25"
                                placeholder="{{ __('teams.create.phone_placeholder') }}"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('phone') border-red-500 @enderror"
                            >

                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    {{-- Address --}}
                    <div class="mt-6">
                        <label for="address"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('teams.create.address') }}
                        </label>

                        <input
                            type="text"
                            name="address"
                            id="address"
                            value="{{ old('address') }}"
                            maxlength="255"
                            placeholder="{{ __('teams.create.address_placeholder') }}"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address') border-red-500 @enderror"
                        >

                        @error('address')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                {{-- Description & Media --}}
                <div class="p-6 sm:p-8 border-b border-gray-200">

                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                            <span class="text-indigo-600 font-bold">≡</span>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                {{ __('teams.create.description_label') }}
                            </h2>

                            <p class="text-xs text-gray-500">
                                {{ __('teams.create.description') }}
                            </p>
                        </div>
                    </div>


                    {{-- Description --}}
                    <div class="mb-6">
                        <label for="description"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('teams.create.description_label') }}
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            placeholder="{{ __('teams.create.description_placeholder') }}"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('description') border-red-500 @enderror"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Logo --}}
                    <div>
                        <label for="logo_path"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('teams.create.team_logo') }}
                        </label>

                        <div class="mt-2 flex items-center justify-center px-6 py-8 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition">

                            <div class="text-center">

                                <svg class="mx-auto h-10 w-10 text-gray-400"
                                     stroke="currentColor"
                                     fill="none"
                                     viewBox="0 0 48 48"
                                     aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h20a4 4 0 004-4V20L28 8z"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M28 8v12h12"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>


                                <div class="mt-3">

                                    <label
                                        for="logo_path"
                                        class="cursor-pointer font-medium text-indigo-600 hover:text-indigo-500"
                                    >
                                        {{ __('teams.create.upload_file') }}

                                        <input
                                            id="logo_path"
                                            name="logo_path"
                                            type="file"
                                            accept="image/jpeg,image/png,image/webp"
                                            class="sr-only"
                                        >
                                    </label>

                                </div>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ __('teams.create.logo_help') }}
                                </p>

                            </div>

                        </div>

                        @error('logo_path')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                {{-- Active Team --}}
                <div class="p-6 sm:p-8 border-b border-gray-200">

                    <div class="flex items-center justify-between">

                        <div>
                            <label for="is_active"
                                   class="text-sm font-semibold text-gray-900">
                                {{ __('teams.create.active_team') }}
                            </label>

                            <p class="mt-1 text-xs text-gray-500">
                                {{ __('teams.active') }}
                            </p>
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
                                {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                                class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            >
                        </div>

                    </div>

                    @error('is_active')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 p-6 sm:p-8">

                    <a href="{{ route('teams.index') }}"
                       class="px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 transition">
                        {{ __('teams.create.cancel') }}
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition"
                    >
                        {{ __('teams.create.save_team') }} →
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection