@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Page Branding --}}
        <div class="mb-3 flex items-center gap-2">
            <span class="h-3 w-3 rounded-full bg-indigo-600"></span>

            <span class="text-sm font-semibold tracking-[0.2em] text-indigo-600 uppercase">
                VOLUNTEAMS
            </span>
        </div>


        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('announcements.create.title') }}
                </h1>

                <p class="mt-2 text-gray-600">
                    {{ __('announcements.create.description') }}
                </p>
            </div>


            {{-- Header Actions --}}
            <div class="flex items-center gap-3">

                {{-- Cancel --}}
                <a href="{{ route('announcements.index') }}"
                   class="inline-flex items-center justify-center
                          px-5 py-2.5
                          border border-gray-300 rounded-lg
                          bg-white hover:bg-gray-50
                          text-sm font-medium text-gray-700
                          shadow-sm transition duration-200">

                    ← {{ __('announcements.create.cancel') }}

                </a>


                {{-- Create --}}
                <button type="submit"
                        form="announcement-create-form"
                        class="inline-flex items-center justify-center
                               px-5 py-2.5
                               border border-transparent rounded-lg
                               shadow-sm text-sm font-semibold text-white
                               bg-indigo-600 hover:bg-indigo-700
                               focus:outline-none focus:ring-2
                               focus:ring-offset-2 focus:ring-indigo-500
                               transition duration-200">

                    {{ __('announcements.create.create_announcement') }}

                    <span class="ml-2">→</span>

                </button>

            </div>

        </div>


        {{-- Form Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">


            {{-- Card Header --}}
            <div class="p-6 sm:p-8 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex items-center gap-4">

                    {{-- Announcement Icon --}}
                    <div class="h-14 w-14 rounded-xl
                                bg-indigo-100 border border-indigo-200
                                flex items-center justify-center
                                text-indigo-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-7 w-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2z" />

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8 12h8M8 16h5" />

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-xl font-bold text-gray-900">
                            {{ __('announcements.create.card_title') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('announcements.create.card_description') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form id="announcement-create-form"
                  action="{{ route('announcements.store') }}"
                  method="POST"
                  class="p-6 sm:p-8 space-y-6">

                @csrf


                {{-- Title --}}
                <div>

                    <label for="title"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('announcements.create.title_field') }}

                        <span class="text-red-500">*</span>

                    </label>


                    <div class="mt-2">

                        <input type="text"
                               name="title"
                               id="title"
                               required
                               value="{{ old('title') }}"
                               placeholder="{{ __('announcements.create.title_placeholder') }}"
                               class="block w-full rounded-lg border-gray-300 shadow-sm
                                      focus:border-indigo-500 focus:ring-indigo-500
                                      sm:text-sm
                                      @error('title')
                                          border-red-300 text-red-900
                                          focus:border-red-500 focus:ring-red-500
                                      @enderror">

                    </div>


                    @error('title')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Content --}}
                <div>

                    <label for="content"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('announcements.create.content') }}

                        <span class="text-red-500">*</span>

                    </label>


                    <div class="mt-2">

                        <textarea name="content"
                                  id="content"
                                  rows="6"
                                  required
                                  placeholder="{{ __('announcements.create.content_placeholder') }}"
                                  class="block w-full rounded-lg border-gray-300 shadow-sm
                                         focus:border-indigo-500 focus:ring-indigo-500
                                         sm:text-sm resize-y
                                         @error('content')
                                             border-red-300 text-red-900
                                             focus:border-red-500 focus:ring-red-500
                                         @enderror">{{ old('content') }}</textarea>

                    </div>


                    @error('content')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('announcements.create.status') }}
                    </label>


                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

                        <div class="flex items-start">

                            <div class="flex items-center h-5">

                                <input type="checkbox"
                                       name="is_active"
                                       id="is_active"
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300
                                              text-indigo-600
                                              focus:ring-indigo-500">

                            </div>


                            <div class="ml-3">

                                <label for="is_active"
                                       class="font-medium text-gray-700 text-sm">

                                    {{ __('announcements.create.active') }}

                                </label>


                                <p class="mt-1 text-xs text-gray-500">

                                    {{ __('announcements.create.active_description') }}

                                </p>

                            </div>

                        </div>

                    </div>


                    @error('is_active')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </form>

        </div>

    </div>

@endsection