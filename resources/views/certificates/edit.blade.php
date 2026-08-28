@extends('layouts.app')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

            {{-- Title --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="h-2.5 w-2.5 rounded-full bg-indigo-600"></span>

                    <span class="text-sm font-semibold tracking-[0.2em] text-indigo-600 uppercase">
                        VOLUNTEAMS
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
                    {{ __('certificates.edit.title') }}
                </h1>

                <p class="mt-2 text-base text-gray-600">
                    {{ __('certificates.edit.description') }}
                </p>
            </div>

            {{-- Top Actions --}}
            <div class="flex items-center gap-3 shrink-0">

                <a href="{{ route('certificates.show', $certificate) }}"
                   class="inline-flex items-center justify-center px-5 py-2.5
                          border border-gray-300 rounded-lg
                          bg-white hover:bg-gray-50
                          text-sm font-medium text-gray-700
                          shadow-sm transition duration-200">

                    ← {{ __('certificates.edit.cancel') }}

                </a>

                <button type="submit"
                        form="certificate-edit-form"
                        class="inline-flex items-center justify-center px-5 py-2.5
                               rounded-lg bg-indigo-600 hover:bg-indigo-700
                               text-white text-sm font-semibold
                               shadow-sm transition duration-200">

                    {{ __('certificates.edit.update_certificate') }} →

                </button>

            </div>

        </div>


        {{-- Main Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- Card Header --}}
            <div class="p-6 sm:p-8 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex items-center gap-4">

                    {{-- Certificate Icon --}}
                    <div class="h-14 w-14 rounded-xl
                                bg-indigo-100 border border-indigo-200
                                flex items-center justify-center
                                text-indigo-600 shrink-0">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-7 w-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M14 3v5h5" />

                        </svg>

                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-gray-900">
                            {{ __('certificates.edit.title') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('certificates.edit.description') }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form id="certificate-edit-form"
                  method="POST"
                  action="{{ route('certificates.update', $certificate) }}"
                  enctype="multipart/form-data"
                  class="p-6 sm:p-8 space-y-6">

                @csrf
                @method('PUT')


                {{-- Certificate Code --}}
                <div class="p-5 rounded-xl border border-gray-200 bg-gray-50">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <div>

                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.edit.certificate_code') }}
                            </span>

                            <span class="mt-1 block text-sm font-mono font-bold text-gray-900 break-all">
                                {{ $certificate->certificate_code }}
                            </span>

                        </div>

                        <span class="inline-flex items-center self-start
                                     px-3 py-1 rounded-full
                                     text-xs font-medium
                                     bg-indigo-100 text-indigo-700">

                            {{ __('certificates.edit.system_generated') }}

                        </span>

                    </div>

                </div>


                {{-- Volunteer --}}
                <div>

                    <label for="user_id"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('certificates.edit.volunteer') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <select id="user_id"
                            name="user_id"
                            required
                            class="mt-2 block w-full rounded-lg border-gray-300
                                   shadow-sm focus:border-indigo-500
                                   focus:ring-indigo-500 sm:text-sm
                                   @error('user_id')
                                       border-red-300 text-red-900
                                       focus:border-red-500 focus:ring-red-500
                                   @enderror">

                        <option value="">
                            {{ __('certificates.edit.select_volunteer') }}
                        </option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}"
                                {{ old('user_id', $certificate->user_id) == $user->id ? 'selected' : '' }}>

                                {{ $user->name }} ({{ $user->email }})

                            </option>

                        @endforeach

                    </select>

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

                        {{ __('certificates.edit.opportunity') }}

                    </label>

                    <select id="opportunity_id"
                            name="opportunity_id"
                            class="mt-2 block w-full rounded-lg border-gray-300
                                   shadow-sm focus:border-indigo-500
                                   focus:ring-indigo-500 sm:text-sm
                                   @error('opportunity_id')
                                       border-red-300 text-red-900
                                       focus:border-red-500 focus:ring-red-500
                                   @enderror">

                        <option value="">
                            {{ __('certificates.edit.select_opportunity') }}
                        </option>

                        @foreach($opportunities as $opportunity)

                            <option value="{{ $opportunity->id }}"
                                {{ old('opportunity_id', $certificate->opportunity_id) == $opportunity->id ? 'selected' : '' }}>

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


                {{-- Issued By --}}
                <div>

                    <label for="issued_by"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('certificates.edit.issued_by') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <select id="issued_by"
                            name="issued_by"
                            required
                            class="mt-2 block w-full rounded-lg border-gray-300
                                   shadow-sm focus:border-indigo-500
                                   focus:ring-indigo-500 sm:text-sm
                                   @error('issued_by')
                                       border-red-300 text-red-900
                                       focus:border-red-500 focus:ring-red-500
                                   @enderror">

                        <option value="">
                            {{ __('certificates.edit.select_issuer') }}
                        </option>

                        @foreach($issuers as $issuer)

                            <option value="{{ $issuer->id }}"
                                {{ old('issued_by', $certificate->issued_by) == $issuer->id ? 'selected' : '' }}>

                                {{ $issuer->name }} ({{ $issuer->email }})

                            </option>

                        @endforeach

                    </select>

                    @error('issued_by')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Issue Date & Time --}}
                <div>

                    <label for="issued_at"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('certificates.edit.issue_date_time') }}

                        <span class="text-red-500">*</span>

                    </label>

                    <input type="datetime-local"
                           id="issued_at"
                           name="issued_at"
                           required
                           value="{{ old(
                               'issued_at',
                               $certificate->issued_at
                                   ? \Carbon\Carbon::parse($certificate->issued_at)->format('Y-m-d\TH:i')
                                   : ''
                           ) }}"
                           class="mt-2 block w-full rounded-lg border-gray-300
                                  shadow-sm focus:border-indigo-500
                                  focus:ring-indigo-500 sm:text-sm
                                  @error('issued_at')
                                      border-red-300 text-red-900
                                      focus:border-red-500 focus:ring-red-500
                                  @enderror">

                    @error('issued_at')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Certificate File --}}
                <div>

                    <label for="file"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('certificates.edit.certificate_file') }}

                    </label>


                    {{-- Existing File --}}
                    @if($certificate->file_path)

                        <div class="mt-2 mb-3 p-4 rounded-xl
                                    border border-gray-200 bg-gray-50">

                            <div class="flex flex-col sm:flex-row
                                        sm:items-center sm:justify-between
                                        gap-3">

                                <p class="text-xs text-gray-600 font-medium">
                                    {{ __('certificates.edit.current_file_exists') }}
                                </p>

                                <a href="{{ asset('storage/' . $certificate->file_path) }}"
                                   target="_blank"
                                   class="inline-flex items-center justify-center
                                          px-3 py-1.5
                                          border border-indigo-300
                                          rounded-md
                                          text-xs font-medium
                                          text-indigo-700
                                          bg-indigo-50
                                          hover:bg-indigo-100
                                          transition shadow-sm">

                                    {{ __('certificates.edit.view_current_certificate') }}

                                </a>

                            </div>

                        </div>

                    @endif


                    {{-- File Input --}}
                    <input type="file"
                           id="file"
                           name="file"
                           class="mt-2 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50
                                  file:text-indigo-700
                                  hover:file:bg-indigo-100">

                    <p class="mt-2 text-xs text-gray-500">
                        {{ __('certificates.edit.keep_current_file') }}
                    </p>

                    @error('file')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Verification URL --}}
                <div>

                    <label for="verification_url"
                           class="block text-sm font-medium text-gray-700">

                        {{ __('certificates.edit.verification_url') }}

                    </label>

                    <input type="url"
                           id="verification_url"
                           name="verification_url"
                           value="{{ old('verification_url', $certificate->verification_url) }}"
                           placeholder="{{ __('certificates.edit.verification_url_placeholder') }}"
                           class="mt-2 block w-full rounded-lg border-gray-300
                                  shadow-sm focus:border-indigo-500
                                  focus:ring-indigo-500 sm:text-sm
                                  @error('verification_url')
                                      border-red-300 text-red-900
                                      focus:border-red-500 focus:ring-red-500
                                  @enderror">

                    @error('verification_url')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </form>


            {{-- Bottom Border Only --}}
            <div class="border-t border-gray-200"></div>

        </div>

    </div>

@endsection