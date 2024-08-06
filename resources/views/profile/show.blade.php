<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>Profile</x-texts.title>

        <section class="flex flex-col border-b-2 border-slate-300/30 pb-4 m-4">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-profile-information-form')
            </div>
            @endif
        </section>

        <section class="flex flex-col border-b-2 border-slate-300/30 pb-4 m-4">
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>
            @endif
        </section>

        <section class="flex flex-col border-b-2 border-slate-300/30 pb-4 m-4">
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>
            @endif
        </section>
        <section class="flex flex-col border-b-2 border-slate-300/30 pb-4 m-4">
            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
            @endif
        </section>
    </div>
</x-app-layout>