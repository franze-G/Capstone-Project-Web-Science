<x-app-layout>
    <div class="m-10 text-white">
        @if (auth()->user()->currentTeam)
        <x-texts.title>Team Management</x-texts.title>
        <section>
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">
                @if (auth()->user()->currentTeam)
                <!-- Display Team Owner Information -->
                <div class="p-5 bg-slate-800">
                    <h2 class="text-2xl font-semibold mb-4">Team Owner</h2>
                    <div class="col-span-6">
                        <div class="flex items-center mt-2">
                            <img class="w-12 h-12 rounded-full object-cover"
                                src="{{ auth()->user()->currentTeam->owner->profile_photo_url }}"
                                alt="{{ auth()->user()->currentTeam->owner->firstname }}">
                            <div class="ms-4 leading-tight">
                                <div class="text-gray-900">{{ auth()->user()->currentTeam->owner->firstname }}
                                    {{ auth()->user()->currentTeam->owner->lastname }}</div>
                                <div class="text-gray-700 text-sm mt-1">
                                    {{ ucfirst(auth()->user()->currentTeam->owner->role) }}
                                </div>
                                <div class="text-gray-700 text-sm">{{ auth()->user()->currentTeam->owner->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 bg-slate-800">

                    <h2 class="text-2xl font-semibold mb-4">Team Members</h2>

                    @foreach ($team->users->sortBy('name') as $user)
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <img class="w-8 h-8 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
                                alt="{{ $user->firstname }}">
                            <div class="ms-4">
                                <p class="font-semibold">{{ $user->firstname }} {{ $user->lastname }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            @if (Gate::check('updateTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                            <button class="ms-2 text-sm text-gray-400 underline"
                                onclick="manageRole('{{ $user->id }}')">
                                {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                            </button>
                            @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                            <div class="ms-2 text-sm text-gray-400">
                                {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                            </div>
                            @endif

                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <!-- Default Freelancer Dashboard -->

                <section class="">

                </section>
                @endif

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