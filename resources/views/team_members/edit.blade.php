@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header Section --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Edit Team Member
                </h1>
                <p class="mt-2 text-gray-600">
                    Update team membership status and joining information.
                </p>
            </div>
            <a href="{{ route('team-members.show', $teamMember) }}"
               class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition duration-200">
                Cancel
            </a>
        </div>

        {{-- Form Container Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('team-members.update', $teamMember) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- Read-Only Information Section --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    {{-- Team (Locked) --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Team (Locked)
                        </label>
                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $teamMember->team?->name ?? 'Unknown Team' }}
                        </p>
                    </div>

                    {{-- User / Member (Locked) --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Member / User (Locked)
                        </label>
                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $teamMember->user?->name ?? 'Unknown User' }}
                        </p>
                        @if($teamMember->user?->email)
                            <p class="text-xs text-gray-500">
                                {{ $teamMember->user->email }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Editable Status Selection --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <select name="status" id="status" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="pending" {{ old('status', $teamMember->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status', $teamMember->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="rejected" {{ old('status', $teamMember->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="left" {{ old('status', $teamMember->status) === 'left' ? 'selected' : '' }}>Left</option>
                        </select>
                    </div>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Editable Joined At Datetime --}}
                <div>
                    <label for="joined_at" class="block text-sm font-medium text-gray-700">
                        Joined At <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span>
                    </label>
                    <div class="mt-1">
                        @php
                            $formattedJoinedAt = old('joined_at', $teamMember->joined_at ? \Carbon\Carbon::parse($teamMember->joined_at)->format('Y-m-d\TH:i') : '');
                        @endphp
                        <input type="datetime-local" name="joined_at" id="joined_at" 
                            value="{{ $formattedJoinedAt }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('joined_at') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
                    </div>
                    @error('joined_at')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('team-members.show', $teamMember) }}" 
                       class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                        Update Team Member
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection