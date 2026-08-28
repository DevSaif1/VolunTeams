<section>

    {{-- Delete Account Card --}}
    <div class="rounded-2xl border border-red-200 bg-white shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="border-b border-red-100 bg-red-50 px-5 py-5 sm:px-6">

            <div class="flex items-start gap-4">

                {{-- Icon --}}
                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600 ring-1 ring-red-200"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 7.5h12M9.75 7.5V5.25h4.5V7.5m-6.75 0v10.875A1.875 1.875 0 009.375 20.25h5.25a1.875 1.875 0 001.875-1.875V7.5M10.5 11.25v5.25m3-5.25v5.25"
                        />
                    </svg>
                </div>

                {{-- Text --}}
                <div class="min-w-0">
                    <h4 class="text-base font-bold text-red-900">
                        {{ __('profile.delete.title') }}
                    </h4>

                    <p class="mt-1 text-sm leading-6 text-red-700">
                        {{ __('profile.delete.description') }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Action Area --}}
        <div class="flex flex-col gap-4 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div>
                <p class="text-sm font-medium text-slate-700">
                    {{ app()->getLocale() === 'ar'
                        ? 'هل أنت متأكد من رغبتك في حذف الحساب؟'
                        : 'Are you sure you want to delete your account?'
                    }}
                </p>

                <p class="mt-1 text-xs leading-5 text-slate-500">
                    {{ app()->getLocale() === 'ar'
                        ? 'سيطلب منك تأكيد كلمة المرور قبل تنفيذ عملية الحذف.'
                        : 'You will be asked to confirm your password before deletion.'
                    }}
                </p>
            </div>


            {{-- Delete Button --}}
            <div class="shrink-0">

                <x-danger-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="inline-flex items-center gap-2 whitespace-nowrap"
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 7.5h12M9.75 7.5V5.25h4.5V7.5m-6.75 0v10.875A1.875 1.875 0 009.375 20.25h5.25a1.875 1.875 0 001.875-1.875V7.5M10.5 11.25v5.25m3-5.25v5.25"
                        />
                    </svg>

                    <span>
                        {{ __('profile.delete.button') }}
                    </span>

                </x-danger-button>

            </div>

        </div>

    </div>


    {{-- Confirmation Modal --}}
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6 sm:p-7"
        >

            @csrf
            @method('delete')


            {{-- Modal Header --}}
            <div class="flex items-start gap-4">

                {{-- Warning Icon --}}
                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600 ring-1 ring-red-200"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.2 12.48A2 2 0 004.82 19h14.36a2 2 0 001.73-2.66l-7.2-12.48a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>


                <div class="min-w-0">

                    <h2 class="text-lg font-bold text-slate-900">
                        {{ __('profile.delete.confirmation_title') }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        {{ __('profile.delete.confirmation_description') }}
                    </p>

                </div>

            </div>


            {{-- Warning Message --}}
            <div class="mt-6 rounded-xl border border-red-100 bg-red-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.2 12.48A2 2 0 004.82 19h14.36a2 2 0 001.73-2.66l-7.2-12.48a2 2 0 00-3.42 0z"
                        />
                    </svg>

                    <p class="text-xs leading-5 text-red-700">
                        {{ app()->getLocale() === 'ar'
                            ? 'هذا الإجراء نهائي ولا يمكن التراجع عنه بعد حذف الحساب.'
                            : 'This action is permanent and cannot be undone once your account is deleted.'
                        }}
                    </p>

                </div>

            </div>


            {{-- Password --}}
            <div class="mt-6">

                <x-input-label
                    for="password"
                    :value="__('profile.delete.password')"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-xl"
                    placeholder="{{ app()->getLocale() === 'ar'
                        ? 'أدخل كلمة المرور الحالية'
                        : 'Enter your current password'
                    }}"
                    required
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>


            {{-- Actions --}}
            <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                {{-- Cancel --}}
                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    type="button"
                    class="justify-center"
                >
                    {{ __('profile.delete.cancel') }}
                </x-secondary-button>


                {{-- Confirm Delete --}}
                <x-danger-button
                    class="justify-center"
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 7.5h12M9.75 7.5V5.25h4.5V7.5m-6.75 0v10.875A1.875 1.875 0 009.375 20.25h5.25a1.875 1.875 0 001.875-1.875V7.5M10.5 11.25v5.25m3-5.25v5.25"
                        />
                    </svg>

                    <span>
                        {{ __('profile.delete.confirm') }}
                    </span>

                </x-danger-button>

            </div>

        </form>

    </x-modal>

</section>