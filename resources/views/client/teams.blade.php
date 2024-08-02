<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>Team Management</x-texts.title>

        <!-- Teams -->
        <section class="flex flex-col border-b-2 border-slate-300/30 pb-4 m-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-semibold">{{ __('Teams') }}</h2>
                <p class="text-white/50">Overview of all the teams you lead</p>
            </div>
            <!-- Team Switcher -->
            <div class="flex flex-row justify-between items-center">
                <div class="text-2xl font-bold">
                    @if (auth()->user()->currentTeam)
                        <div class="flex flex-wrap">
                            @if (Auth::user()->isClient() || Auth::user()->isFreelancer())
                                @php
                                    $teams = Auth::user()->isClient()
                                        ? Auth::user()->allTeams()->where('archived', false)
                                        : Auth::user()->teams->where('archived', false);
                                @endphp
                                @if ($teams->isEmpty())
                                    <div class="py-2 text-xs text-gray-400">
                                        {{ __('No Active Teams') }}
                                    </div>
                                @else
                                    @foreach ($teams as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
                <div class="flex self-end gap-2">
                    @if (Auth::user()->isClient() && auth()->user()->can('create', Laravel\Jetstream\Jetstream::newTeamModel()))
                        <x-buttons.a-button :href="route('teams.create')">create team</x-buttons.a-button>
                        <x-buttons.a-button :href="route('teams.index')">archive</x-buttons.a-button>
                        <x-buttons.a-button class="bg-red-400 hover:bg-red-800"
                            :href="route('teams.create')">delete</x-buttons.a-button>

                        <!-- place it somewhere else since for freelance to-->
                        @if (Auth::user()->isFreelancer())
                            <x-buttons.a-button :href="route('team.invite')">create team</x-buttons.a-button>
                        @endif
                    @endif

                </div>
        </section>

        <!-- Team Owner -->
        <section class=" flex justify-between gap-10 items-start mb-6 m-4 border-b-2 border-slate-300/30 *:flex-col">
            @if (auth()->user()->currentTeam)
                <div class="flex w-2/4">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Team Owner') }}</h2>
                    <p class="text-white/50">The primary contact for the project team, facilitating collaboration and
                        problem-solving to overcome
                        challenges and achieve project goal.</p>
                </div>
                <div class="flex w-3/4 justify-center">
                    <h2 class="font-semibold text-2xl mb-1">{{ auth()->user()->currentTeam->owner->firstname }}</h2>
                    <div class=" mb-4 leading-tight text-gray-900">
                        <img class="w-14 h-14 rounded-full object-cover mb-3"
                            src="{{ auth()->user()->currentTeam->owner->profile_photo_url }}"
                            alt="{{ auth()->user()->currentTeam->owner->firstname }}">
                        <x-buttons.email-button>{{ auth()->user()->currentTeam->owner->email }}</x-buttons.email-button>
                    </div>
                </div>
            @endif
        </section>

        <!-- Team Members -->
        <section class="flex justify-between gap-10 mb-6 m-4 pb-4 border-b-2 border-slate-300/30 *:flex-col">
            @if (auth()->user()->currentTeam)
                <div class="flex w-1/4">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Team Members') }}</h2>
                    <p class="text-white/50">Manage your team composition in this section. Add or remove team members,
                        and assign
                        roles to encourage collaboration.
                    </p>
                </div>
                <div class="flex w-2/4">
                    @foreach ($team->users->sortBy('name') as $user)
                        <div class="flex items-center">
                            <img class="w-8 h-8 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
                                alt="{{ $user->firstname }}">
                            <div class="ms-4">{{ $user->firstname }} {{ $user->lastname }}</div>
                            <div class="ml-4">{{ $user->email }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end w-1/4">
                    <x-input.input-box id="email" name="email" type="email" wire:model="addTeamMemberForm.email"
                        placeholder="freelancer@example.com" />
                    <x-input-error for="email" class="mt-2" />
                    <x-button class="ml-auto mt-3">add another</x-button>
                </div>
            @endif
        </section>


        <!-- Team Settings -->
        <section class="flex justify-between gap-10 mb-6 m-4 border-b-2 border-slate-300/30 py-2 ">
            <div class="flex flex-col w-1/4">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Team Settings') }}</h2>
                <p class="text-white/50">Manage your team composition in this section. Add or remove team members, and
                    assign
                    roles to encourage collaboration.
                </p>
            </div>
            <div class="flex w-3/4 justify-end items-end">
                <!-- Team Settings -->
                @if (Auth::user()->currentTeam)
                    @if (
                        (Auth::user()->isClient() && Auth::user()->allTeams()->where('archived', false)->isEmpty()) ||
                            (Auth::user()->isFreelancer() && Auth::user()->teams->where('archived', false)->isEmpty()))
                        <x-buttons.a-button class="opacity-50 cursor-not-allowed select-none">
                            team settings
                        </x-buttons.a-button>
                    @else
                        <x-buttons.a-button href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            class="p-12 ml-auto">team
                            settings
                        </x-buttons.a-button>
                    @endif
                @endif
            </div>
        </section>

    </div>
</x-app-layout>
