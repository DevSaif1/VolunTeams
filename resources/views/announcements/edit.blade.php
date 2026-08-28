@extends('layouts.app')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="h-2.5 w-2.5 rounded-full bg-indigo-600"></span>

                    <span class="text-sm font-semibold tracking-[0.2em] text-indigo-600 uppercase">
                        VOLUNTEAMS
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
                    {{ __('announcements.edit.title') }}
                </h1>

                <p class="mt-2 text-gray-600">
                    {{ __('announcements.edit.description') }}
                </p>
            </div>

            {{-- Header Actions --}}
            <div class="flex items-center gap-3 shrink-0">

                <a href="{{ route('announcements.show', $announcement) }}"
                   class="inline-flex items-center justify-center px-5 py-2.5
                          border border-gray-300 rounded-lg bg-white
                          hover:bg-gray-50 text-sm font-medium text-gray-700
                          shadow-sm transition duration-200">

                    ← {{ __('announcements.edit.cancel') }}

                </a>

                <button type="submit"
                        form="announcement-edit-form"
                        class="inline-flex items-center justify-center px-5 py-2.5
                               rounded-lg bg-indigo-600 hover:bg-indigo-700
                               text-white text-sm font-semibold shadow-sm
                               transition duration-200">

                    {{ __('announcements.edit.update_announcement') }} →

                </button>

            </div>
        </div>


        {{-- Form Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- Card Header --}}
            <div class="p-6 sm:p-8 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div class="h-16 w-16 rounded-xl bg-indigo-100 border border-indigo-200
                                flex items-center justify-center text-indigo-600 shrink-0">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-8 w-8"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4 5.5A2.5 2.5 0 016.5 3h9A2.5 2.5 0 0118 5.5v13a2.5 2.5 0 01-2.5 2.5h-9A2.5 2.5 0 014 18.5v-13z"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8 8h8M8 12h8M8 16h5"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                            {{ __('announcements.edit.card_title') }}
                        </h2>

                        <p class="mt-1 text-gray-600">
                            {{ __('announcements.edit.card_description') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form id="announcement-edit-form"
                  action="{{ route('announcements.update', $announcement) }}"
                  method="POST"
                  class="p-6 sm:p-8 space-y-7">

                @csrf
                @method('PUT')


                {{-- Title --}}
                <div>

                    <label for="title"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('announcements.edit.title_field') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <input type="text"
                           name="title"
                           id="title"
                           required
                           value="{{ old('title', $announcement->title) }}"
                           placeholder="{{ __('announcements.edit.title_placeholder') }}"
                           class="mt-2 block w-full rounded-lg border-gray-300
                                  shadow-sm focus:border-indigo-500
                                  focus:ring-indigo-500 sm:text-sm
                                  @error('title')
                                      border-red-300 text-red-900
                                      focus:border-red-500 focus:ring-red-500
                                  @enderror">

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

                        {{ __('announcements.edit.content') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <textarea name="content"
                              id="content"
                              rows="7"
                              required
                              placeholder="{{ __('announcements.edit.content_placeholder') }}"
                              class="mt-2 block w-full rounded-lg border-gray-300
                                     shadow-sm focus:border-indigo-500
                                     focus:ring-indigo-500 sm:text-sm
                                     resize-y
                                     @error('content')
                                         border-red-300 text-red-900
                                         focus:border-red-500 focus:ring-red-500
                                     @enderror">{{ old('content', $announcement->content) }}</textarea>

                    @error('content')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('announcements.edit.status') }}
                    </label>

                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

                        <div class="flex items-start gap-3">

                            <div class="flex items-center h-5 pt-0.5">

                                <input type="checkbox"
                                       name="is_active"
                                       id="is_active"
                                       value="1"
                                       {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300
                                              text-indigo-600
                                              focus:ring-indigo-500">

                            </div>

                            <div>

                                <label for="is_active"
                                       class="font-medium text-gray-700">

                                    {{ __('announcements.edit.active') }}

                                </label>

                                <p class="mt-1 text-xs text-gray-500">

                                    {{ __('announcements.edit.active_description') }}

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