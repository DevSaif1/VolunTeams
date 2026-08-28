@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm">
                <div class="flex items-center gap-2">

                    <svg class="w-5 h-5 text-green-500"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 0l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd" />
                    </svg>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>

                </div>
            </div>
        @endif


        {{-- Page Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

            <div>

                {{-- Brand --}}
                <div class="flex items-center gap-2 mb-3">

                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>

                    <span class="text-xs font-semibold tracking-[0.2em] text-indigo-600">
                        VOLUNTEAMS
                    </span>

                </div>

                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
                    {{ __('certificates.title') }}
                </h1>

                <p class="mt-2 text-base text-gray-600">

                    @if(auth()->user()->hasRole('Member'))

                        {{ __('certificates.member_description') }}

                    @elseif(auth()->user()->hasRole('Team Manager'))

                        {{ __('certificates.manager_description') }}

                    @else

                        {{ __('certificates.manage_description') }}

                    @endif

                </p>

            </div>


            {{-- Issue Certificate --}}
            @if(auth()->user()->hasAnyRole(['Admin', 'Team Manager']))

                <a href="{{ route('certificates.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition duration-200 whitespace-nowrap">

                    <span class="text-lg leading-none">+</span>

                    {{ __('certificates.issue_certificate') }}

                </a>

            @endif

        </div>


        {{-- Main Card --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">


            {{-- Card Header --}}
            <div class="px-6 py-6 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">

                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center flex-shrink-0">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-lg font-bold text-gray-900">
                            {{ __('certificates.title') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">

                            @if(auth()->user()->hasRole('Member'))

                                {{ __('certificates.member_description') }}

                            @elseif(auth()->user()->hasRole('Team Manager'))

                                {{ __('certificates.manager_description') }}

                            @else

                                {{ __('certificates.manage_description') }}

                            @endif

                        </p>

                    </div>

                </div>

            </div>


            {{-- Certificates Table --}}
            <div class="w-full overflow-hidden">

                <table class="w-full table-fixed">

                    {{-- Balanced Column Widths --}}
                    <colgroup>

                        {{-- Volunteer --}}
                        <col class="w-[16%]">

                        {{-- Opportunity --}}
                        <col class="w-[13%]">

                        {{-- Certificate Code --}}
                        <col class="w-[17%]">

                        {{-- Issued By --}}
                        <col class="w-[12%]">

                        {{-- Issued At --}}
                        <col class="w-[10%]">

                        {{-- Files & Verification --}}
                        <col class="w-[14%]">

                        {{-- Actions --}}
                        <col class="w-[18%]">

                    </colgroup>


                    {{-- Table Header --}}
                    <thead class="bg-gray-50 border-b border-gray-200">

                        <tr>

                            <th class="px-4 py-4 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.index.volunteer') }}
                            </th>

                            <th class="px-4 py-4 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.index.opportunity') }}
                            </th>

                            <th class="px-4 py-4 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.index.certificate_code') }}
                            </th>

                            <th class="px-4 py-4 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.index.issued_by') }}
                            </th>

                            <th class="px-4 py-4 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.index.issued_at') }}
                            </th>

                            <th class="px-3 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.index.files_verification') }}
                            </th>

                            <th class="px-3 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('certificates.index.actions') }}
                            </th>

                        </tr>

                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-200">

                        @forelse ($certificates as $certificate)

                            <tr class="hover:bg-gray-50 transition duration-150">


                                {{-- Volunteer --}}
                                <td class="px-4 py-5 align-middle">

                                    <div class="flex items-center gap-3 min-w-0">

                                        <div class="flex-shrink-0 h-11 w-11 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center text-sm font-bold text-indigo-600">

                                            {{ strtoupper(substr($certificate->user?->name ?? 'UV', 0, 2)) }}

                                        </div>


                                        <div class="min-w-0">

                                            <div class="text-sm font-semibold text-gray-900 truncate"
                                                 title="{{ $certificate->user?->name ?? __('certificates.unknown_volunteer') }}">

                                                {{ $certificate->user?->name ?? __('certificates.unknown_volunteer') }}

                                            </div>


                                            @if($certificate->user?->email)

                                                <div class="text-xs text-gray-500 mt-1 truncate"
                                                     title="{{ $certificate->user->email }}">

                                                    {{ $certificate->user->email }}

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Opportunity --}}
                                <td class="px-4 py-5 align-middle">

                                    <div class="text-sm font-semibold text-indigo-600 break-words">

                                        {{ $certificate->opportunity?->title ?? __('certificates.general_certificate') }}

                                    </div>

                                </td>


                                {{-- Certificate Code --}}
                                <td class="px-4 py-5 align-middle">

                                    <span
                                        class="block w-full px-2.5 py-2 rounded-lg text-[11px] font-mono font-semibold bg-gray-100 text-gray-800 border border-gray-200 break-all leading-4"
                                        title="{{ $certificate->certificate_code }}">

                                        {{ $certificate->certificate_code }}

                                    </span>

                                </td>


                                {{-- Issued By --}}
                                <td class="px-4 py-5 align-middle">

                                    <div class="text-sm font-medium text-gray-900 break-words">

                                        {{ $certificate->issuer?->name ?? __('certificates.not_available') }}

                                    </div>

                                </td>


                                {{-- Issued At --}}
                                <td class="px-4 py-5 align-middle text-sm text-gray-600">

                                    {{ $certificate->issued_at
                                        ? \Carbon\Carbon::parse($certificate->issued_at)->format('M d, Y')
                                        : __('certificates.not_available')
                                    }}

                                </td>


                                {{-- Files & Verification --}}
                                <td class="px-3 py-5 align-middle">

                                    <div class="flex flex-col items-center justify-center gap-2 w-full">


                                        {{-- View File --}}
                                        @if($certificate->file_path)

                                            <a href="{{ asset('storage/' . $certificate->file_path) }}"
                                               target="_blank"
                                               class="inline-flex items-center justify-center gap-1.5 w-full max-w-[130px] px-2.5 py-2 rounded-lg bg-indigo-50 border border-indigo-100 text-xs font-medium text-indigo-600 hover:bg-indigo-100 hover:text-indigo-700 transition whitespace-nowrap">

                                                <span>📄</span>

                                                <span>
                                                    {{ __('certificates.index.view_file') }}
                                                </span>

                                            </a>

                                        @endif


                                        {{-- Public Verify --}}
                                        <a href="{{ route('certificates.verify', $certificate->certificate_code) }}"
                                           target="_blank"
                                           class="inline-flex items-center justify-center gap-1.5 w-full max-w-[130px] px-2.5 py-2 rounded-lg bg-green-50 border border-green-100 text-xs font-medium text-green-600 hover:bg-green-100 hover:text-green-700 transition whitespace-nowrap">
                                            <span>🔗</span>
                                            <span>
                                                {{ __('certificates.index.verify') }}
                                            </span>
                                        </a>


                                        {{-- No File --}}
                                        @if(!$certificate->file_path)
                                            <span class="text-xs text-gray-400 text-center">
                                                {{ __('certificates.no_file_uploaded') }}
                                            </span>
                                        @endif


                                {{-- Actions --}}
                                <td class="px-3 py-5 align-middle">

                                    <div class="flex items-center justify-center gap-1.5 whitespace-nowrap">


                                        {{-- View --}}
                                        <a href="{{ route('certificates.show', $certificate) }}"
                                           class="inline-flex items-center justify-center px-2.5 py-2 rounded-lg border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 transition whitespace-nowrap">

                                            {{ __('certificates.index.view') }}

                                        </a>


                                        {{-- Admin + Team Manager --}}
                                        @if(auth()->user()->hasAnyRole(['Admin', 'Team Manager']))


                                            {{-- Edit --}}
                                            <a href="{{ route('certificates.edit', $certificate) }}"
                                               class="inline-flex items-center justify-center px-2.5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold transition whitespace-nowrap">

                                                {{ __('certificates.index.edit') }}

                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('certificates.destroy', $certificate) }}"
                                                  method="POST"
                                                  class="inline-flex"
                                                  onsubmit="return confirm('{{ __('certificates.index.delete_confirmation') }}')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="inline-flex items-center justify-center px-2.5 py-2 rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-100 text-xs font-medium transition whitespace-nowrap">

                                                    {{ __('certificates.index.delete') }}

                                                </button>

                                            </form>


                                        @endif

                                    </div>

                                </td>

                            </tr>


                        @empty


                            {{-- Empty State --}}
                            <tr>

                                <td colspan="7" class="px-6 py-12 text-center">

                                    <div class="flex flex-col items-center justify-center">

                                        <div class="w-14 h-14 rounded-xl bg-gray-100 text-gray-400 flex items-center justify-center mb-4">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-7 h-7"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                            </svg>

                                        </div>


                                        @if(auth()->user()->hasRole('Member'))

                                            <p class="text-sm text-gray-500">
                                                {{ __('certificates.index.no_certificates_member') }}
                                            </p>

                                        @else

                                            <p class="text-sm text-gray-500">
                                                {{ __('certificates.index.no_certificates') }}
                                            </p>

                                        @endif

                                    </div>

                                </td>

                            </tr>


                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($certificates->hasPages())

                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">

                    {{ $certificates->links() }}

                </div>

            @endif


        </div>

    </div>

@endsection