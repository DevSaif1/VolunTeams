<footer
    id="footer"
    class="bg-slate-950 text-slate-300 border-t border-slate-800"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
             MAIN FOOTER
        ====================================================== --}}
        <div
            class="py-12 sm:py-14
                   grid grid-cols-1
                   md:grid-cols-2
                   lg:grid-cols-4
                   gap-10 lg:gap-12"
        >

            {{-- =================================================
                 BRAND
            ================================================== --}}
            <div class="lg:col-span-1">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center gap-3
                           group"
                >

                    <div
                        class="w-11 h-11
                               rounded-xl
                               bg-white
                               border border-slate-700
                               flex items-center
                               justify-center
                               overflow-hidden
                               shadow-sm
                               group-hover:shadow-md
                               transition-shadow duration-200"
                    >
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="{{ __('landing.nav.brand') }}"
                            class="w-9 h-9 object-contain"
                        >
                    </div>

                    <span
                        class="text-xl font-extrabold
                               text-white
                               tracking-tight"
                    >
                        {{ __('landing.nav.brand') }}
                    </span>

                </a>


                <p
                    class="mt-5 max-w-sm
                           text-sm
                           leading-7
                           text-slate-400"
                >
                    {{ __('landing.footer.project_note') }}
                </p>


                {{-- Small Brand Accent --}}
                <div class="mt-6 flex items-center gap-2">

                    <span
                        class="w-2 h-2
                               rounded-full
                               bg-emerald-500"
                    ></span>

                    <span
                        class="text-xs
                               font-semibold
                               text-emerald-400"
                    >
                        VolunTeams
                    </span>

                </div>

            </div>


            {{-- =================================================
                 QUICK LINKS
            ================================================== --}}
            <div>

                <h3
                    class="text-sm
                           font-bold
                           text-white"
                >
                    {{ __('landing.footer.quick_links') }}
                </h3>


                <nav
                    class="mt-5
                           flex flex-col
                           gap-3"
                >

                    <a
                        href="#hero"
                        class="text-sm text-slate-400
                               hover:text-emerald-400
                               transition-colors duration-200"
                    >
                        {{ __('landing.nav.home') }}
                    </a>

                    <a
                        href="#features"
                        class="text-sm text-slate-400
                               hover:text-emerald-400
                               transition-colors duration-200"
                    >
                        {{ __('landing.nav.features') }}
                    </a>

                    <a
                        href="#roles"
                        class="text-sm text-slate-400
                               hover:text-emerald-400
                               transition-colors duration-200"
                    >
                        {{ __('landing.nav.roles') }}
                    </a>

                    <a
                        href="#tech"
                        class="text-sm text-slate-400
                               hover:text-emerald-400
                               transition-colors duration-200"
                    >
                        {{ __('landing.nav.tech') }}
                    </a>

                </nav>

            </div>


            {{-- =================================================
                 ABOUT PROJECT
            ================================================== --}}
            <div>

                <h3
                    class="text-sm
                           font-bold
                           text-white"
                >
                    {{ __('landing.footer.about_project') }}
                </h3>


                <p
                    class="mt-5
                           text-sm
                           leading-7
                           text-slate-400"
                >
                    {{ __('landing.footer.about_text') }}
                </p>

            </div>


            {{-- =================================================
                 CONTACT & SUPPORT
            ================================================== --}}
            <div>

                <h3
                    class="text-sm
                           font-bold
                           text-white"
                >
                    {{ __('landing.footer.contact') }}
                </h3>


                <p
                    class="mt-5
                           text-sm
                           leading-7
                           text-slate-400"
                >
                    {{ __('landing.footer.contact_text') }}
                </p>


                <div class="mt-5">

                    @guest

                        <x-button
                            href="{{ route('register') }}"
                            variant="primary"
                            class="px-5 py-2.5
                                   bg-emerald-600
                                   hover:bg-emerald-700
                                   focus:ring-emerald-500"
                        >
                            {{ __('landing.footer.get_started') }}

                            <span class="ms-2">→</span>
                        </x-button>

                    @else

                        <x-button
                            href="{{ route('dashboard') }}"
                            variant="primary"
                            class="px-5 py-2.5
                                   bg-emerald-600
                                   hover:bg-emerald-700
                                   focus:ring-emerald-500"
                        >
                            {{ __('landing.nav.dashboard') }}

                            <span class="ms-2">→</span>
                        </x-button>

                    @endguest

                </div>

            </div>

        </div>


        {{-- =====================================================
             BOTTOM BAR
        ====================================================== --}}
        <div
            class="border-t border-slate-800
                   py-6
                   flex flex-col
                   sm:flex-row
                   items-center
                   justify-between
                   gap-4"
        >

            <p
                class="text-xs
                       text-slate-500
                       text-center
                       sm:text-start"
            >
                &copy; {{ date('Y') }}
                {{ __('landing.nav.brand') }}.
                {{ __('landing.footer.rights') }}
            </p>


            <div
                class="flex items-center gap-2
                       text-xs
                       text-slate-500"
            >

                <span
                    class="w-1.5 h-1.5
                           rounded-full
                           bg-emerald-500"
                ></span>

                <span>
                    VolunTeams
                </span>

            </div>

        </div>

    </div>
</footer>