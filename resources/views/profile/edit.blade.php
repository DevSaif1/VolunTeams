<x-app-layout>

    <x-slot name="header">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div>
                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-[0.2em]">
                    VolunTeams
                </p>

                <h2 class="mt-2 text-3xl font-bold text-gray-900">
                    {{ __('profile.title') }}
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    {{ __('profile.profile_information.description') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Profile Information --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                <div class="px-6 sm:px-8 py-6 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">
                    <div class="flex items-center gap-4">

                        <div class="h-12 w-12 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ __('profile.profile_information.title') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('profile.profile_information.description') }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </div>


            {{-- Update Password --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                <div class="px-6 sm:px-8 py-6 bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200">
                    <div class="flex items-center gap-4">

                        <div class="h-12 w-12 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M16.5 10.5V7.875a4.875 4.875 0 00-9.75 0V10.5m-1.5 0h12.75A1.5 1.5 0 0119.5 12v7.125a1.5 1.5 0 01-1.5 1.5H6a1.5 1.5 0 01-1.5-1.5V12A1.5 1.5 0 015.25 10.5z"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ __('profile.password.title') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('profile.password.description') }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>

            </div>


            {{-- Delete Account --}}
            <div class="bg-white rounded-xl border border-red-200 shadow-sm overflow-hidden">

                <div class="px-6 sm:px-8 py-6 bg-red-50 border-b border-red-100">
                    <div class="flex items-center gap-4">

                        <div class="h-12 w-12 rounded-xl bg-red-100 border border-red-200 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M6 7.5h12M9.75 7.5V5.25h4.5V7.5m-6.75 0v10.875A1.875 1.875 0 009.375 20.25h5.25a1.875 1.875 0 001.875-1.875V7.5M10.5 11.25v5.25m3-5.25v5.25"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ __('profile.delete.title') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('profile.delete.description') }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>

        </div>
    </div>

</x-app-layout>