<x-guest-layout>
    <x-authentication-card>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex justify-center m-3">
                <svg width="207" height="73" viewBox="0 0 207 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.762695 13C0.762695 6.05 7.1127 -5.00679e-06 18.6627 -5.00679e-06C24.8127 -5.00679e-06 29.0627 1 32.9127 2.3V9H32.4127C32.4127 9 29.3627 0.599999 18.6627 0.599999C9.3627 0.599999 4.2627 6.25 4.2627 11.8C4.2627 25.5 35.8627 20.65 35.8627 38.15C35.8627 45.1 28.6627 52 17.1127 52C10.5127 52 4.6627 48.65 0.962695 45.9V39.2H1.4627C1.4627 39.2 8.0127 51.1 19.9127 51.1C27.2127 51.1 32.9627 45.75 32.9627 40.2C32.9627 25.15 0.762695 29.4 0.762695 13ZM53.876 51H40.376V50.5C44.676 50.5 44.976 46.95 44.976 37.1V29.5C44.976 19.65 44.676 16.1 40.376 16.1V15.6H49.276V37.1C49.276 46.95 49.576 50.5 53.876 50.5V51ZM43.526 9.05C43.526 7.2 45.026 5.7 46.876 5.7C48.726 5.7 50.226 7.2 50.226 9.05C50.226 10.9 48.726 12.4 46.876 12.4C45.026 12.4 43.526 10.9 43.526 9.05ZM71.6916 72.75C62.5416 72.75 55.8916 68.95 55.8916 61.55C55.8916 57.15 59.7416 54.2 63.6416 54.2C68.2416 54.2 70.0916 56.4 74.7416 56.4C75.9416 56.4 78.2416 55.75 77.7416 53.9L77.9416 53.85C79.8416 56.25 78.0416 60.55 73.7416 60.55C70.0416 60.55 68.0916 58.35 63.5416 58.35C61.2916 58.35 58.8416 60.05 58.8416 62.5C58.8416 68.35 64.2416 72.25 71.7916 72.25C79.4916 72.25 86.5916 66.05 86.5916 57.5C86.5916 52.3 82.1416 48.5 75.4416 48.5C71.3416 48.5 70.3416 49.4 66.4916 49.4C64.4916 49.4 62.2916 48.5 62.2916 46.5C62.2916 39.2 83.4916 45.55 83.4916 28.25C83.4916 21.5 79.4916 15.2 72.6916 15.2C65.8916 15.2 61.8416 21.65 61.8416 28.4C61.8416 35.2 66.5416 39.75 72.1916 39.75V40.2C71.3416 40.35 70.4916 40.4 69.6916 40.4C62.3916 40.4 57.5416 34.8 57.5416 28.4C57.5416 21.3 63.1916 14.6 72.6916 14.6H87.7916V16.2L76.9916 15.1C83.8416 16.8 87.7916 22.45 87.7916 28.4C87.7916 46.65 62.8416 40.2 62.8416 46.4C62.8416 48.05 64.7916 48.9 66.4916 48.9C71.2416 48.9 74.4916 46.5 79.2416 46.5C85.1416 46.5 90.3416 51.1 90.3416 57.1C90.3416 65.8 83.2916 72.75 71.6916 72.75ZM92.8174 50.5C97.1174 50.5 97.4174 46.95 97.4174 37.1V29.5C97.4174 19.65 97.1174 16.1 92.8174 16.1V15.6H98.5174C102.617 15.6 108.867 14.6 111.717 14.6C116.167 14.6 125.067 15.25 125.067 25.75V37.1C125.067 46.95 125.367 50.5 129.667 50.5V51H116.167V50.5C120.467 50.5 120.767 46.95 120.767 37.1C120.767 35.6 120.717 26.8 120.717 26.8C120.717 15.6 112.867 15.3 109.467 15.3C106.917 15.3 104.117 15.9 101.717 16.75V37.1C101.717 46.95 102.017 50.5 106.317 50.5V51H92.8174V50.5ZM131.673 16.1V15.6H140.573C140.573 17.1 140.623 39.8 140.623 39.8C140.623 51 148.473 51.3 151.873 51.3C154.423 51.3 157.223 50.7 159.623 49.85V29.5C159.623 19.65 159.323 16.1 155.023 16.1V15.6H163.923V37.1C163.923 46.95 164.223 50.5 168.523 50.5V51H162.823C158.723 51 152.473 52 149.623 52C145.173 52 136.273 51.35 136.273 40.85V29.5C136.273 19.65 135.973 16.1 131.673 16.1ZM170.54 16.1V15.6H179.44V21.45C182.44 16.95 186.64 14.6 191.59 14.6C199.94 14.6 206.24 20.5 206.24 30.1C206.24 43.4 197.74 51 186.19 51C183.64 51 182.79 51 179.44 50.2V57.85C179.44 67.7 179.74 71.25 184.04 71.25V71.75H170.54V71.25C174.84 71.25 175.14 67.7 175.14 57.85V29.5C175.14 19.65 174.84 16.1 170.54 16.1ZM179.44 29.15V49.05C181.04 49.9 183.19 50.5 185.59 50.5C194.14 50.5 201.89 42.55 201.89 31.15C201.89 19.9 195.34 15.8 189.44 15.8C184.29 15.8 179.44 19.3 179.44 29.15Z"
                        fill="black" />
                </svg>
            </div>

            <!-- names -->
            <div class="grid w-full gap-6 mt-4 md:grid-cols-2">
                <div>
                    <x-label for="firstname" value="{{ __('First Name') }}" />
                    <x-input id="firstname" class="block w-full mt-1" type="text" name="firstname" :value="old('firstname')"
                        required autofocus autocomplete="firstname" />
                </div>
                <div>
                    <x-label for="lastname" value="{{ __('Last Name') }}" />
                    <x-input id="lastname" class="block w-full mt-1" type="text" name="lastname" :value="old('lastname')"
                        required autofocus autocomplete="lastname" />
                </div>
            </div>
            <!-- roles -->
            <x-label value="{{ __('Role') }}" class="mt-4 mb-1" />

            <div class="grid w-full gap-6 md:grid-cols-2">
                <div>
                    <input type="radio" name="role" value="client" id="client"
                        {{ old('role', $userType) === 'client' ? 'checked' : '' }} class="hidden peer" />
                    <label for="client"
                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 border border-gray-300 cursor-pointer rounded-xl dark:hover:text-gray-300 dark:border-gray-300 dark:peer-checked:text-emerald peer-checked:border-emerald peer-checked:text-emeraldlight1 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Client</div>
                            <div class="w-full">managing a project</div>
                        </div>
                        <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </label>
                </div>
                <div>
                    <input type="radio" name="role" value="freelancer" id="freelancer"
                        {{ old('role', $userType) === 'freelancer' ? 'checked' : '' }} class="hidden peer" required />
                    <label for="freelancer"
                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 border border-gray-300 cursor-pointer rounded-xl dark:hover:text-gray-300 dark:border-gray-300 dark:peer-checked:text-emerald peer-checked:border-emerald peer-checked:text-emeraldlight1 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Freelancer</div>
                            <div class="w-full">looking for work</div>
                        </div>
                        <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </label>
                </div>
            </div>


            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <!-- password container -->
            <div class="grid w-full gap-6 md:grid-cols-2">
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>


            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the Lokalista&#39s :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '"
                                                                                                                                class="p-1 text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald">' .
                                        __('Terms
                                                                                                                                of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '"
                                                                                                                                class="p-1 text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald">' .
                                        __('Privacy
                                                                                                                                Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="p-1 text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald rounded-xl"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="p-2 ms-4">
                    {{ __('Create Account') }}
                </x-button>
            </div>
        </form>
        <x-validation-errors class="flex flex-col items-center mt-4" />
    </x-authentication-card>
</x-guest-layout>
