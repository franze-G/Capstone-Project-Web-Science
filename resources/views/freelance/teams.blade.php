<x-app-layout>
    <div class="m-10 text-white">
        @if (auth()->user()->currentTeam)
        <x-texts.title>Team Management</x-texts.title>


        <!-- Team Switcher -->
        <section class="flex flex-col border-b-2 border-slate-300/30 pb-4 m-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-semibold">{{ __('Switch Teams') }}</h2>
                <p class="text-white/50">Overview of all the teams you joined</p>
            </div>

            <div class="flex flex-row justify-between items-center">
                <div class="text-2xl font-bold">
                    @if (auth()->user()->currentTeam)
                    <div class="flex flex-wrap">
                        @php
                        $teams = Auth::user()->isFreelancer()
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
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Team Owner -->
        <section class="flex flex-col border-b-2 border-slate-300/30 pb-6 m-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-semibold">{{ __('Team Owner') }}</h2>
                <div class="flex items-center mt-3">
                    <img class="w-20 h-20 rounded-full object-cover"
                        src="{{ auth()->user()->currentTeam->owner->profile_photo_url }}"
                        alt="{{ auth()->user()->currentTeam->owner->firstname }}">
                    <div class="ms-4 leading-tight">
                        <div class="text-gray-900 text-lg">{{ auth()->user()->currentTeam->owner->firstname }}
                            {{ auth()->user()->currentTeam->owner->lastname }}</div>
                        <div class="flex flex-col text-md text-gray-700 mt-2">
                            <p>{{ ucfirst(auth()->user()->currentTeam->owner->role) }}</p>
                            <p>{{ auth()->user()->currentTeam->owner->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Members -->
        <section class="flex flex-col pb-4 m-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-semibold">{{ __('Team Members') }}</h2>

                <!-- Image and Name -->
                @foreach ($team->users->sortBy('name') as $user)
                <div class="flex items-center justify-between mb-4 mt-3">
                    <div class="flex items-center">
                        <img class="w-20 h-20 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
                            alt="{{ $user->firstname }}">
                        <div class="ms-4 text-gray-900 text-md leading-tight">
                            <p>{{ $user->firstname }} {{ $user->lastname }}</p>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="flex items-center">
                        @if (Gate::check('updateTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                        <button class="ms-2 text-sm text-gray-400 underline" onclick="manageRole('{{ $user->id }}')">
                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                        </button>
                        @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                        <div class="ms-2 text-md text-gray-400">
                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                        </div>
                        @endif

                    </div>
                </div>
                @endforeach
            </div>
        </section>


        @else
        <section class="flex justify-center items-center">
            <p class="text-center text-lg md:text-xl lg:text-3xl">
                {{ auth()->user()->firstname }} is not currently in a team.
            </p>
        </section>

        @endif
    </div>
</x-app-layout>