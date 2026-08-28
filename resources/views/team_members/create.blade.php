@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header Section --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Add Team Member
                </h1>
                <p class="mt-2 text-gray-600">
                    Assign a user to a specific team and set their initial status.
                </p>
            </div>
            <a href="{{ route('team-members.index') }}"
               class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-sm font-medium text-gray-700 shadow-sm transition duration-200">
                Back to Team Members
            </a>
        </div>

        {{-- Form Container Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('team-members.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf

                {{-- Information Card --}}
                <div class="p-4 bg-indigo-50 border-l-4 border-indigo-500 text-indigo-900 rounded-r-lg shadow-sm">
                    <p class="text-sm font-bold">Important Note</p>
                    <ul class="mt-1 text-xs text-indigo-700 space-y-1">
                        <li>• A user cannot be added to the same team twice.</li>
                        <li>• Default status for new members is "Pending" unless otherwise specified.</li>
                    </ul>
                </div>

                {{-- Team Selection --}}
                <div>
                    <label for="team_id" class="block text-sm font-medium text-gray-700">
                        Team <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <select name="team_id" id="team_id" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('team_id') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="" disabled {{ old('team_id') ? '' : 'selected' }}>
                                -- Select Team --
                            </option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('team_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- User Selection --}}
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">
                        User / Member <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <select name="user_id" id="user_id" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('user_id') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>
                                -- Select User --
                            </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} {{ $user->email ? '— ' . $user->email : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Selection --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <select name="status" id="status" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="left" {{ old('status') == 'left' ? 'selected' : '' }}>Left</option>
                        </select>
                    </div>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Joined At Datetime --}}
                <div>
                    <label for="joined_at" class="block text-sm font-medium text-gray-700">
                        Joined At <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span>
                    </label>
                    <div class="mt-1">
                        <input type="datetime-local" name="joined_at" id="joined_at" 
                            value="{{ old('joined_at') }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('joined_at') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
                    </div>
                    @error('joined_at')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('team-members.index') }}" 
                       class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                        ➕ Add Team Member
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection