<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>Team Settings</x-texts.title>
        <section>
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                @livewire('teams.update-team-name-form', ['team' => $team])

                @livewire('teams.team-member-manager', ['team' => $team])

                @if (Gate::check('delete', $team) && !$team->personal_team)
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('teams.delete-team-form', ['team' => $team])
                </div>
                @endif
            </div>
        </section>
    </div>
</x-app-layout>