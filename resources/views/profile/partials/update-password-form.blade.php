<section>

    <form
        method="post"
        action="{{ route('password.update') }}"
        class="space-y-6"
    >

        @csrf
        @method('put')


        {{-- Current Password --}}
        <div>

            <x-input-label
                for="update_password_current_password"
                :value="__('profile.password.current')"
            />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-2 block w-full"
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />

        </div>


        {{-- New Password --}}
        <div>

            <x-input-label
                for="update_password_password"
                :value="__('profile.password.new')"
            />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-2 block w-full"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />

        </div>


        {{-- Confirm Password --}}
        <div>

            <x-input-label
                for="update_password_password_confirmation"
                :value="__('profile.password.confirm')"
            />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-2 block w-full"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />

        </div>


        {{-- Actions --}}
        <div class="flex items-center gap-4 pt-2">

            <x-primary-button>
                {{ __('profile.password.save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600"
                >
                    {{ __('profile.password.saved') }}
                </p>

            @endif

        </div>

    </form>

</section>