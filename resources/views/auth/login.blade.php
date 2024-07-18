<x-guest-layout>
    <x-authentication-card>
        <div class="flex justify-center m-3">
            <svg width="167" height="73" viewBox="0 0 167 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0.771484 0.5H14.2715V0.999997C9.97149 0.999997 9.67148 4.55 9.67148 14.4V50H16.0215C20.7715 50 36.0215 49.45 36.0215 42.25H36.5215V50.5H0.771484V50C5.07148 50 5.37148 46.45 5.37148 36.6V14.4C5.37148 4.55 5.07148 0.999997 0.771484 0.999997V0.5ZM55.7008 51.5C44.9508 51.5 38.5508 43.1 38.5508 32.8C38.5508 22.5 44.9508 14.1 55.7008 14.1C66.4508 14.1 72.9508 22.5 72.9508 32.8C72.9508 43.1 66.4508 51.5 55.7008 51.5ZM42.8008 32.8C42.8008 43.8 47.9508 50.9 55.7008 50.9C63.4508 50.9 68.7008 43.8 68.7008 32.8C68.7008 21.8 63.4508 14.7 55.7008 14.7C47.9508 14.7 42.8008 21.8 42.8008 32.8ZM92.7316 72.25C83.5816 72.25 76.9316 68.45 76.9316 61.05C76.9316 56.65 80.7816 53.7 84.6816 53.7C89.2816 53.7 91.1316 55.9 95.7816 55.9C96.9816 55.9 99.2816 55.25 98.7816 53.4L98.9816 53.35C100.882 55.75 99.0816 60.05 94.7816 60.05C91.0816 60.05 89.1316 57.85 84.5816 57.85C82.3316 57.85 79.8816 59.55 79.8816 62C79.8816 67.85 85.2816 71.75 92.8316 71.75C100.532 71.75 107.632 65.55 107.632 57C107.632 51.8 103.182 48 96.4816 48C92.3816 48 91.3816 48.9 87.5316 48.9C85.5316 48.9 83.3316 48 83.3316 46C83.3316 38.7 104.532 45.05 104.532 27.75C104.532 21 100.532 14.7 93.7316 14.7C86.9316 14.7 82.8816 21.15 82.8816 27.9C82.8816 34.7 87.5816 39.25 93.2316 39.25V39.7C92.3816 39.85 91.5316 39.9 90.7316 39.9C83.4316 39.9 78.5816 34.3 78.5816 27.9C78.5816 20.8 84.2316 14.1 93.7316 14.1H108.832V15.7L98.0316 14.6C104.882 16.3 108.832 21.95 108.832 27.9C108.832 46.15 83.8816 39.7 83.8816 45.9C83.8816 47.55 85.8316 48.4 87.5316 48.4C92.2816 48.4 95.5316 46 100.282 46C106.182 46 111.382 50.6 111.382 56.6C111.382 65.3 104.332 72.25 92.7316 72.25ZM127.357 50.5H113.857V50C118.157 50 118.457 46.45 118.457 36.6V29C118.457 19.15 118.157 15.6 113.857 15.6V15.1H122.757V36.6C122.757 46.45 123.057 50 127.357 50V50.5ZM117.007 8.55C117.007 6.7 118.507 5.2 120.357 5.2C122.207 5.2 123.707 6.7 123.707 8.55C123.707 10.4 122.207 11.9 120.357 11.9C118.507 11.9 117.007 10.4 117.007 8.55ZM129.873 50C134.173 50 134.473 46.45 134.473 36.6V29C134.473 19.15 134.173 15.6 129.873 15.6V15.1H135.573C139.673 15.1 145.923 14.1 148.773 14.1C153.223 14.1 162.123 14.75 162.123 25.25V36.6C162.123 46.45 162.423 50 166.723 50V50.5H153.223V50C157.523 50 157.823 46.45 157.823 36.6C157.823 35.1 157.773 26.3 157.773 26.3C157.773 15.1 149.923 14.8 146.523 14.8C143.973 14.8 141.173 15.4 138.773 16.25V36.6C138.773 46.45 139.073 50 143.373 50V50.5H129.873V50Z"
                    fill="black" />
            </svg>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-black">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="flex flex-row justify-between text-center text-gray-600 text-sm mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2">{{ __('Remember me') }}</span>
                </label>
                <a class="underline underline-offset-1 hover:text-emeraldlight1 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emeraldlight1"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class=" text-sm text-gray-600 hover:text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald p-1"
                    href="{{ route('register') }}">

                    {{ __('Register') }}
                </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>