@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header Section --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('certificates.show.title') }}
                </h1>

                <p class="mt-2 text-gray-600">
                    {{ __('certificates.show.description') }}
                </p>
            </div>

            {{-- Header Actions --}}
            <div class="flex items-center gap-3">

                <a href="{{ route('certificates.index') }}"
                   class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition duration-200">
                    ← {{ __('certificates.show.back_to_certificates') }}
                </a>

                @if(auth()->user()->hasAnyRole(['Admin', 'Team Manager']))
                    <a href="{{ route('certificates.edit', $certificate) }}"
                       class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                        {{ __('certificates.show.edit_certificate') }} →
                    </a>
                @endif

            </div>
        </div>


        {{-- Main Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- Summary Header --}}
            <div class="p-6 sm:p-8 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

                    {{-- Volunteer --}}
                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center shrink-0">
                            <span class="text-xl font-bold text-indigo-600">
                                {{ strtoupper(substr($certificate->user?->name ?? 'VO', 0, 2)) }}
                            </span>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">
                                {{ __('certificates.show.volunteer_recipient') }}
                            </p>

                            <h2 class="mt-1 text-xl font-bold text-gray-900">
                                {{ $certificate->user?->name ?? __('certificates.unknown_volunteer') }}
                            </h2>

                            <p class="text-sm text-gray-600">
                                {{ $certificate->user?->email ?? __('certificates.no_email_available') }}
                            </p>
                        </div>

                    </div>


                    {{-- Certificate Code --}}
                    <div class="sm:text-right">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            {{ __('certificates.show.certificate_code') }}
                        </p>

                        <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-mono font-bold bg-indigo-100 text-indigo-700 border border-indigo-200 break-all">
                            {{ $certificate->certificate_code }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- Details Section --}}
            <div class="p-6 sm:p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Opportunity --}}
                    <div class="md:col-span-2 border border-gray-200 rounded-xl p-6">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('certificates.show.opportunity') }}
                        </p>

                        <p class="mt-2 text-lg font-semibold text-indigo-600">
                            {{ $certificate->opportunity?->title ?? __('certificates.general_certificate') }}
                        </p>

                    </div>


                    {{-- Issued By --}}
                    <div class="border border-gray-200 rounded-xl p-6">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('certificates.show.issued_by') }}
                        </p>

                        <p class="mt-2 text-base font-semibold text-gray-900">
                            {{ $certificate->issuer?->name ?? __('certificates.not_available') }}
                        </p>

                        @if($certificate->issuer?->email)
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $certificate->issuer->email }}
                            </p>
                        @endif

                    </div>


                    {{-- Issued At --}}
                    <div class="border border-gray-200 rounded-xl p-6">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('certificates.show.issued_at') }}
                        </p>

                        <p class="mt-2 text-base font-semibold text-gray-900">
                            {{ $certificate->issued_at
                                ? \Carbon\Carbon::parse($certificate->issued_at)->format('M d, Y h:i A')
                                : __('certificates.not_available') }}
                        </p>

                    </div>


                    {{-- Certificate File --}}
                    <div class="border border-gray-200 rounded-xl p-6">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('certificates.show.certificate_file') }}
                        </p>

                        <div class="mt-3">

                            @if($certificate->file_path)

                                <a href="{{ asset('storage/' . $certificate->file_path) }}"
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-indigo-700 bg-indigo-50 border border-indigo-200 hover:bg-indigo-100 transition duration-200">
                                    📄 {{ __('certificates.show.view_download_file') }}
                                </a>

                            @else

                                <p class="text-sm text-gray-500 italic">
                                    {{ __('certificates.show.no_file_uploaded') }}
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- Verification URL --}}
                    <div class="border border-gray-200 rounded-xl p-6">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('certificates.show.verification_url') }}
                        </p>

                        <div class="mt-3">

                            @if($certificate->verification_url)

                                <a href="{{ $certificate->verification_url }}"
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-green-700 bg-green-50 border border-green-200 hover:bg-green-100 transition duration-200">
                                    🔗 {{ __('certificates.show.verify_certificate') }}
                                </a>

                            @else

                                <p class="text-sm text-gray-500 italic">
                                    {{ __('certificates.show.not_provided') }}
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- Record Created At --}}
                    <div class="border border-gray-200 rounded-xl p-6">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('certificates.show.record_created_at') }}
                        </p>

                        <p class="mt-2 text-sm font-semibold text-gray-900">
                            {{ $certificate->created_at
                                ? $certificate->created_at->format('M d, Y h:i A')
                                : __('certificates.not_available') }}
                        </p>

                    </div>


                    {{-- Last Updated At --}}
                    <div class="border border-gray-200 rounded-xl p-6">

                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('certificates.show.last_updated_at') }}
                        </p>

                        <p class="mt-2 text-sm font-semibold text-gray-900">
                            {{ $certificate->updated_at
                                ? $certificate->updated_at->format('M d, Y h:i A')
                                : __('certificates.not_available') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection