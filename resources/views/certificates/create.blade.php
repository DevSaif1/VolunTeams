@extends('layouts.app')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

            {{-- Title Section --}}
            <div>

                {{-- VolunTeams Label --}}
                <div class="flex items-center gap-2 mb-3">

                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>

                    <span class="text-xs font-semibold tracking-[0.2em] text-indigo-600">
                        VOLUNTEAMS
                    </span>

                </div>

                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('certificates.create.title') }}
                </h1>

                <p class="mt-2 text-gray-600">
                    {{ __('certificates.manage_description') }}
                </p>

            </div>


            {{-- Header Actions --}}
            <div class="flex items-center justify-end gap-3">

                {{-- Cancel --}}
                <a href="{{ route('certificates.index') }}"
                   class="inline-flex items-center justify-center
                          px-5 py-2.5
                          border border-gray-300
                          rounded-lg
                          bg-white
                          hover:bg-gray-50
                          text-sm font-medium
                          text-gray-700
                          shadow-sm
                          transition duration-200
                          whitespace-nowrap">

                    {{ __('certificates.create.cancel') }}

                </a>


                {{-- Issue Certificate --}}
                <button type="submit"
                        form="certificate-create-form"
                        class="inline-flex items-center justify-center gap-2
                               px-5 py-2.5
                               border border-transparent
                               rounded-lg
                               shadow-sm
                               text-sm font-semibold
                               text-white
                               bg-indigo-600
                               hover:bg-indigo-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-offset-2
                               focus:ring-indigo-500
                               transition duration-200
                               whitespace-nowrap">

                    {{ __('certificates.create.issue_certificate') }}

                    <span>→</span>

                </button>

            </div>

        </div>


        {{-- Main Form Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">


            {{-- Card Header --}}
            <div class="px-6 sm:px-8 py-6
                        bg-gradient-to-r from-indigo-50 to-white
                        border-b border-gray-200">

                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div class="flex items-center justify-center
                                w-12 h-12
                                rounded-xl
                                bg-indigo-100
                                text-indigo-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-lg font-bold text-gray-900">
                            {{ __('certificates.create.title') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('certificates.manage_description') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form id="certificate-create-form"
                  method="POST"
                  action="{{ route('certificates.store') }}"
                  enctype="multipart/form-data">

                @csrf


                {{-- Form Fields --}}
                <div class="p-6 sm:p-8 space-y-6">


                    {{-- Volunteer --}}
                    <div>

                        <label for="user_id"
                               class="block text-sm font-medium text-gray-700">

                            {{ __('certificates.create.volunteer') }}

                            <span class="text-red-500">*</span>

                        </label>


                        <select id="user_id"
                                name="user_id"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300
                                       shadow-sm
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       sm:text-sm
                                       @error('user_id')
                                           border-red-300
                                           focus:border-red-500
                                           focus:ring-red-500
                                       @enderror">

                            <option value="">
                                {{ __('certificates.create.select_volunteer') }}
                            </option>

                            @foreach($users ?? [] as $user)

                                <option value="{{ $user->id }}"
                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>

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

                            {{ __('certificates.create.opportunity') }}

                        </label>


                        <select id="opportunity_id"
                                name="opportunity_id"
                                class="mt-2 block w-full rounded-lg border-gray-300
                                       shadow-sm
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       sm:text-sm
                                       @error('opportunity_id')
                                           border-red-300
                                           focus:border-red-500
                                           focus:ring-red-500
                                       @enderror">

                            <option value="">
                                {{ __('certificates.create.select_opportunity') }}
                            </option>

                            @foreach($opportunities ?? [] as $opportunity)

                                <option value="{{ $opportunity->id }}"
                                    {{ old('opportunity_id') == $opportunity->id ? 'selected' : '' }}>

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

                            {{ __('certificates.create.issued_by') }}

                            <span class="text-red-500">*</span>

                        </label>


                        <select id="issued_by"
                                name="issued_by"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300
                                       shadow-sm
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       sm:text-sm
                                       @error('issued_by')
                                           border-red-300
                                           text-red-900
                                           focus:border-red-500
                                           focus:ring-red-500
                                       @enderror">

                            <option value="">
                                {{ __('certificates.create.select_issuer') }}
                            </option>

                            @foreach($issuers ?? [] as $issuer)

                                <option value="{{ $issuer->id }}"
                                    {{ old('issued_by', auth()->id()) == $issuer->id ? 'selected' : '' }}>

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

                            {{ __('certificates.create.issue_date_time') }}

                            <span class="text-red-500">*</span>

                        </label>


                        <input id="issued_at"
                               type="datetime-local"
                               name="issued_at"
                               value="{{ old('issued_at', now()->format('Y-m-d\TH:i')) }}"
                               required
                               class="mt-2 block w-full rounded-lg border-gray-300
                                      shadow-sm
                                      focus:border-indigo-500
                                      focus:ring-indigo-500
                                      sm:text-sm
                                      @error('issued_at')
                                          border-red-300
                                          text-red-900
                                          focus:border-red-500
                                          focus:ring-red-500
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

                            {{ __('certificates.create.certificate_file') }}

                        </label>


                        <input id="file"
                               type="file"
                               name="file"
                               class="mt-2 block w-full text-sm text-gray-500

                                      file:mr-4
                                      file:py-2
                                      file:px-4
                                      file:rounded-lg
                                      file:border-0
                                      file:text-sm
                                      file:font-semibold
                                      file:bg-indigo-50
                                      file:text-indigo-700

                                      hover:file:bg-indigo-100

                                      focus:outline-none">


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

                            {{ __('certificates.create.verification_url') }}

                        </label>


                        <input id="verification_url"
                               type="url"
                               name="verification_url"
                               value="{{ old('verification_url') }}"
                               placeholder="{{ __('certificates.create.verification_url_placeholder') }}"
                               class="mt-2 block w-full rounded-lg border-gray-300
                                      shadow-sm
                                      focus:border-indigo-500
                                      focus:ring-indigo-500
                                      sm:text-sm
                                      @error('verification_url')
                                          border-red-300
                                          text-red-900
                                          focus:border-red-500
                                          focus:ring-red-500
                                      @enderror">


                        @error('verification_url')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection