<nav x-data="{ open: false }" class="bg-white border-b border-slate-200">
    <div class="w-full max-w-[1600px] mx-auto px-6 lg:px-8 2xl:px-10">

        {{-- ================= DESKTOP NAVBAR ================= --}}
        <div class="flex items-center h-16 gap-3">

            {{-- Logo --}}
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="block">
                    <x-application-logo class="block h-9 w-auto fill-current text-slate-800" />
                </a>
            </div>


            {{-- ================= DESKTOP NAVIGATION ================= --}}
            <div class="hidden 2xl:flex flex-1 min-w-0 items-center justify-center">

                <div class="flex items-center gap-2 min-w-0 whitespace-nowrap">

                    {{-- Dashboard --}}
                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        class="text-sm whitespace-nowrap"
                    >
                        @if(auth()->user()->hasRole('Admin'))
                            {{ __('dashboard.admin_dashboard') }}
                        @elseif(auth()->user()->hasRole('Team Manager'))
                            {{ __('dashboard.manager_dashboard') }}
                        @elseif(auth()->user()->hasRole('Member'))
                            {{ __('dashboard.member_dashboard') }}
                        @endif
                    </x-nav-link>


                    {{-- ================= ADMIN ================= --}}
                    @if(auth()->user()->hasRole('Admin'))

                        <x-nav-link
                            :href="route('users.index')"
                            :active="request()->routeIs('users.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.users_members') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('teams.index')"
                            :active="request()->routeIs('teams.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.teams') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('opportunities.index')"
                            :active="request()->routeIs('opportunities.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.opportunities') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('applications.index')"
                            :active="request()->routeIs('applications.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.applications') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('volunteer-hours.index')"
                            :active="request()->routeIs('volunteer-hours.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.volunteer_hours') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('certificates.index')"
                            :active="request()->routeIs('certificates.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.certificates') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('announcements.index')"
                            :active="request()->routeIs('announcements.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.announcements') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('reports.index')"
                            :active="request()->routeIs('reports.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('reports.title') }}
                        </x-nav-link>

                    @endif


                    {{-- ================= TEAM MANAGER ================= --}}
                    @if(auth()->user()->hasRole('Team Manager'))

                        <x-nav-link
                            :href="route('teams.index')"
                            :active="request()->routeIs('teams.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.teams') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('team-members.index')"
                            :active="request()->routeIs('team-members.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.team_members') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('opportunities.index')"
                            :active="request()->routeIs('opportunities.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.opportunities') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('applications.index')"
                            :active="request()->routeIs('applications.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.applications') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('volunteer-hours.index')"
                            :active="request()->routeIs('volunteer-hours.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.volunteer_hours') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('certificates.index')"
                            :active="request()->routeIs('certificates.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.certificates') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('announcements.index')"
                            :active="request()->routeIs('announcements.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.announcements') }}
                        </x-nav-link>

                    @endif


                    {{-- ================= MEMBER ================= --}}
                    @if(auth()->user()->hasRole('Member'))

                        <x-nav-link
                            :href="route('teams.index')"
                            :active="request()->routeIs('teams.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.teams') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('opportunities.index')"
                            :active="request()->routeIs('opportunities.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.opportunities') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('applications.index')"
                            :active="request()->routeIs('applications.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.applications') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('volunteer-hours.index')"
                            :active="request()->routeIs('volunteer-hours.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.volunteer_hours') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('certificates.index')"
                            :active="request()->routeIs('certificates.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.certificates') }}
                        </x-nav-link>

                        <x-nav-link
                            :href="route('announcements.index')"
                            :active="request()->routeIs('announcements.*')"
                            class="text-sm whitespace-nowrap"
                        >
                            {{ __('dashboard.announcements') }}
                        </x-nav-link>

                    @endif

                </div>
            </div>


            {{-- ================= RIGHT SIDE ================= --}}
            <div class="hidden 2xl:flex shrink-0 items-center gap-3">

                {{-- Language --}}
                <div class="flex items-center gap-2 text-sm whitespace-nowrap">

                    <a
                        href="{{ route('language.switch', 'en') }}"
                        class="transition-colors
                        {{ app()->getLocale() === 'en'
                            ? 'font-bold text-indigo-600'
                            : 'text-slate-500 hover:text-indigo-600' }}"
                    >
                        English
                    </a>

                    <span class="text-slate-300">|</span>

                    <a
                        href="{{ route('language.switch', 'ar') }}"
                        class="transition-colors
                        {{ app()->getLocale() === 'ar'
                            ? 'font-bold text-indigo-600'
                            : 'text-slate-500 hover:text-indigo-600' }}"
                    >
                        العربية
                    </a>

                </div>


                {{-- User Dropdown --}}
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-2 px-2 py-2
                                   text-sm font-medium text-slate-600
                                   bg-white hover:text-slate-900
                                   focus:outline-none transition"
                        >

                            {{-- Avatar --}}
                            @if(Auth::user()->profile_photo_path)

                                <img
                                    src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                    alt="{{ Auth::user()->name }}"
                                    class="h-9 w-9 rounded-full object-cover border border-slate-200"
                                >

                            @else

                                <div
                                    class="h-9 w-9 rounded-full
                                           bg-indigo-100 text-indigo-700
                                           flex items-center justify-center
                                           font-bold text-sm border border-indigo-200"
                                >
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                            @endif

                            <span class="hidden lg:block max-w-32 truncate">
                                {{ Auth::user()->name }}
                            </span>

                            <svg
                                class="fill-current h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>

                        </button>

                    </x-slot>


                    {{-- Dropdown Content --}}
                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('dashboard.profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="block w-full text-start px-4 py-2 text-sm
                                       text-slate-700 hover:bg-slate-100
                                       focus:outline-none transition"
                            >
                                {{ __('dashboard.logout') }}
                            </button>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- ================= MOBILE / TABLET HAMBURGER ================= --}}
            <div class="ms-auto flex items-center 2xl:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2
                           rounded-md text-slate-500
                           hover:text-slate-700 hover:bg-slate-100
                           focus:outline-none transition"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>
    </div>


    {{-- ================= MOBILE / TABLET MENU ================= --}}
    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden 2xl:hidden border-t border-slate-200 bg-white"
    >

        <div class="pt-2 pb-3 space-y-1">

            {{-- Dashboard --}}
            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            >
                @if(auth()->user()->hasRole('Admin'))
                    {{ __('dashboard.admin_dashboard') }}
                @elseif(auth()->user()->hasRole('Team Manager'))
                    {{ __('dashboard.manager_dashboard') }}
                @elseif(auth()->user()->hasRole('Member'))
                    {{ __('dashboard.member_dashboard') }}
                @endif
            </x-responsive-nav-link>


            {{-- ================= ADMIN ================= --}}
            @if(auth()->user()->hasRole('Admin'))

                <x-responsive-nav-link :href="route('users.index')">
                    {{ __('dashboard.users_members') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('teams.index')">
                    {{ __('dashboard.teams') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('opportunities.index')">
                    {{ __('dashboard.opportunities') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('applications.index')">
                    {{ __('dashboard.applications') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('volunteer-hours.index')">
                    {{ __('dashboard.volunteer_hours') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('certificates.index')">
                    {{ __('dashboard.certificates') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('announcements.index')">
                    {{ __('dashboard.announcements') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('reports.index')">
                    {{ __('dashboard.reports') }}
                </x-responsive-nav-link>

            @endif


            {{-- ================= TEAM MANAGER ================= --}}
            @if(auth()->user()->hasRole('Team Manager'))

                <x-responsive-nav-link :href="route('teams.index')">
                    {{ __('dashboard.teams') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('team-members.index')">
                    {{ __('dashboard.team_members') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('opportunities.index')">
                    {{ __('dashboard.opportunities') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('applications.index')">
                    {{ __('dashboard.applications') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('volunteer-hours.index')">
                    {{ __('dashboard.volunteer_hours') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('certificates.index')">
                    {{ __('dashboard.certificates') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('announcements.index')">
                    {{ __('dashboard.announcements') }}
                </x-responsive-nav-link>

            @endif


            {{-- ================= MEMBER ================= --}}
            @if(auth()->user()->hasRole('Member'))

                <x-responsive-nav-link :href="route('teams.index')">
                    {{ __('dashboard.teams') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('opportunities.index')">
                    {{ __('dashboard.opportunities') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('applications.index')">
                    {{ __('dashboard.applications') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('volunteer-hours.index')">
                    {{ __('dashboard.volunteer_hours') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('certificates.index')">
                    {{ __('dashboard.certificates') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('announcements.index')">
                    {{ __('dashboard.announcements') }}
                </x-responsive-nav-link>

            @endif

        </div>

            {{-- ================= MOBILE LANGUAGE SWITCHER ================= --}}
            <div class="border-t border-slate-200 px-4 py-4">

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm font-semibold text-slate-600">
                        {{ __('dashboard.language') }}
                    </span>

                    <div class="flex items-center gap-2 text-sm">

                        <a
                            href="{{ route('language.switch', 'en') }}"
                            class="rounded-lg px-3 py-2 transition
                            {{ app()->getLocale() === 'en'
                                ? 'bg-emerald-50 font-bold text-emerald-700'
                                : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800' }}"
                        >
                            English
                        </a>

                        <a
                            href="{{ route('language.switch', 'ar') }}"
                            class="rounded-lg px-3 py-2 transition
                            {{ app()->getLocale() === 'ar'
                                ? 'bg-emerald-50 font-bold text-emerald-700'
                                : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800' }}"
                        >
                            العربية
                        </a>

                    </div>

                </div>

            </div>

        {{-- ================= MOBILE USER ================= --}}
        <div class="pt-4 pb-4 border-t border-slate-200">

            <div class="px-4 flex items-center gap-3">

                @if(Auth::user()->profile_photo_path)

                    <img
                        src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                        alt="{{ Auth::user()->name }}"
                        class="h-10 w-10 rounded-full object-cover border border-slate-200"
                    >

                @else

                    <div
                        class="h-10 w-10 rounded-full
                               bg-indigo-100 text-indigo-700
                               flex items-center justify-center font-bold"
                    >
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                @endif

                <div class="min-w-0">

                    <div class="font-medium text-base text-slate-800 truncate">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="font-medium text-sm text-slate-500 truncate">
                        {{ Auth::user()->email }}
                    </div>

                </div>

            </div>


            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('dashboard.profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="block w-full text-start px-4 py-2
                               text-sm text-slate-700
                               hover:bg-slate-100 transition"
                    >
                        {{ __('dashboard.logout') }}
                    </button>

                </form>

            </div>

        </div>

    </div>
</nav>