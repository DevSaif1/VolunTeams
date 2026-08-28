@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header Section --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Team Member Details
                </h1>
                <p class="mt-2 text-gray-600">
                    Detailed membership information and activity dates.
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('team-members.index') }}"
                   class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition duration-200">
                    Back to Team Members
                </a>
                <a href="{{ route('team-members.edit', $teamMember) }}"
                   class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200">
                    ✏️ Edit Member
                </a>
            </div>
        </div>

        {{-- Details Container Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            {{-- Summary Banner --}}
            <div class="p-6 bg-gray-50 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Member / User</span>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $teamMember->user?->name ?? 'Unknown User' }}
                    </h2>
                    <p class="text-sm text-gray-600">
                        {{ $teamMember->user?->email ?? 'No email available' }}
                    </p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Status</span>
                    @if ($teamMember->status === 'active')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                            Active
                        </span>
                    @elseif ($teamMember->status === 'pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @elseif ($teamMember->status === 'rejected')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                            Rejected
                        </span>
                    @elseif ($teamMember->status === 'left')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                            Left
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                            {{ ucfirst($teamMember->status) }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Main Details Grid --}}
            <div class="p-6 sm:p-8">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Assigned Team --}}
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Assigned Team</dt>
                        <dd class="mt-1 text-lg font-medium text-indigo-600">
                            {{ $teamMember->team?->name ?? 'Unknown Team' }}
                        </dd>
                    </div>

                    {{-- Joined At --}}
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Joined At</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $teamMember->joined_at ? \Carbon\Carbon::parse($teamMember->joined_at)->format('M d, Y h:i A') : 'N/A' }}
                        </dd>
                    </div>

                    {{-- Record Created At --}}
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Record Created At</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $teamMember->created_at ? $teamMember->created_at->format('M d, Y h:i A') : 'N/A' }}
                        </dd>
                    </div>

                    {{-- Last Updated At --}}
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Last Updated At</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $teamMember->updated_at ? $teamMember->updated_at->format('M d, Y h:i A') : 'N/A' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection