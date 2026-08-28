<x-guest-layout>

    {{-- Header --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-7 w-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2z"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8 10V7a4 4 0 118 0v3"
                />
            </svg>

        </div>

        <h2 class="text-2xl font-bold tracking-tight text-slate-900">
            {{ app()->getLocale() === 'ar'
                ? 'تحقق من هويتك'
                : 'Verify your identity'
            }}
        </h2>

        <p class="mt-3 text-sm leading-6 text-slate-500">

            @if (app()->getLocale() === 'ar')

                أدخل رمز التحقق المكوّن من 6 أرقام
                الذي تم إنشاؤه لحسابك.

            @else

                Enter the 6-digit verification code
                generated for your account.

            @endif

        </p>

        <div class="mt-3 text-sm font-medium text-slate-700">
            {{ $email }}
        </div>

    </div>


    {{-- Errors --}}
    @if ($errors->any())

        <div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">

            {{ $errors->first() }}

        </div>

    @endif


    {{-- Demo OTP --}}
    @if ($demoOtp)

        <div class="mb-6 rounded-xl border border-indigo-100 bg-indigo-50 px-4 py-4 text-center">

            <p class="text-xs font-medium text-indigo-600">
                {{ app()->getLocale() === 'ar'
                    ? 'رمز التحقق التجريبي'
                    : 'Demo verification code'
                }}
            </p>

            <div class="mt-2 text-2xl font-bold tracking-[0.35em] text-indigo-700">
                {{ $demoOtp }}
            </div>

            <p class="mt-2 text-xs text-indigo-500">

                {{ app()->getLocale() === 'ar'
                    ? 'يظهر هذا الرمز مؤقتًا لأننا في وضع التطوير.'
                    : 'This code is shown temporarily because the system is in demo mode.'
                }}

            </p>

        </div>

    @endif


    {{-- OTP Form --}}
    <form
        method="POST"
        action="{{ route('password.otp.check') }}"
    >

        @csrf

        {{-- Important: send the email with the OTP --}}
        <input
            type="hidden"
            name="email"
            value="{{ $email }}"
        >


        {{-- OTP --}}
        <div>

            <x-input-label
                for="otp"
                :value="app()->getLocale() === 'ar'
                    ? 'رمز التحقق'
                    : 'Verification Code'"
            />

            <input
                id="otp"
                name="otp"
                type="text"
                inputmode="numeric"
                autocomplete="one-time-code"
                maxlength="6"
                pattern="[0-9]{6}"
                required
                autofocus
                class="mt-2 block w-full rounded-xl border border-slate-200 px-4 py-4 text-center text-2xl font-bold tracking-[0.5em] text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                placeholder="••••••"
            />

            <x-input-error
                :messages="$errors->get('otp')"
                class="mt-2"
            />

        </div>


        {{-- Timer --}}
        <div
            class="mt-5 text-center text-sm text-slate-500"
            id="otp-timer-container"
        >

            <span>
                {{ app()->getLocale() === 'ar'
                    ? 'ينتهي الرمز خلال'
                    : 'Code expires in'
                }}
            </span>

            <span
                id="otp-timer"
                class="font-semibold text-indigo-600"
            >
                05:00
            </span>

        </div>


        {{-- Verify --}}
        <div class="mt-6">

            <button
                type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >

                <span>
                    {{ app()->getLocale() === 'ar'
                        ? 'تحقق من الرمز'
                        : 'Verify Code'
                    }}
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 rtl:rotate-180"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14m-6-6l6 6-6 6"
                    />
                </svg>

            </button>

        </div>


        {{-- Request new code --}}
        <div class="mt-6 text-center">

            <a
                href="{{ route('password.request') }}"
                class="text-sm font-medium text-slate-500 transition hover:text-indigo-600"
            >

                {{ app()->getLocale() === 'ar'
                    ? 'طلب رمز جديد'
                    : 'Request a new code'
                }}

            </a>

        </div>

    </form>


    {{-- OTP Timer --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            let seconds = 5 * 60;

            const timer = document.getElementById('otp-timer');

            const interval = setInterval(function () {

                const minutes = Math.floor(seconds / 60);

                const remainingSeconds = seconds % 60;

                timer.textContent =
                    String(minutes).padStart(2, '0') +
                    ':' +
                    String(remainingSeconds).padStart(2, '0');

                if (seconds <= 0) {

                    clearInterval(interval);

                    timer.textContent =
                        '{{ app()->getLocale() === "ar"
                            ? "انتهت صلاحية الرمز"
                            : "Code expired"
                        }}';

                    timer.classList.remove('text-indigo-600');

                    timer.classList.add('text-red-600');

                }

                seconds--;

            }, 1000);

        });

    </script>

</x-guest-layout>