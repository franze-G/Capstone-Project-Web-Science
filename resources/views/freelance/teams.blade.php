<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (auth()->user()->currentTeam)
                <!-- Display team name if the user is on a team -->
                {{ auth()->user()->currentTeam->name }} Dashboard
            @else
                <!-- Display default client dashboard text -->
                {{ __('Freelancer Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                    <div class="p-5 bg-slate-800">
                        <!-- title container -->
                        <div class="flex justify-between items-center">
                            <div
                                class="flex flex-col justify-center items-start gap-1 font-sfprodisplay tracking-tight">
                                <h1 class="text-4xl font-semibold">Freelancer Dashboard</h1>
                                <p class="text-base font-extralight">Welcome to your dashboard</p>
                            </div>
                            <a href="/" class="flex justify-between items-center">
                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.1429 5.21429H7.28571V1.35714C7.28571 0.883839 6.90188 0.5 6.42857 0.5H5.57143C5.09812 0.5 4.71429 0.883839 4.71429 1.35714V5.21429H0.857143C0.383839 5.21429 0 5.59812 0 6.07143V6.92857C0 7.40188 0.383839 7.78571 0.857143 7.78571H4.71429V11.6429C4.71429 12.1162 5.09812 12.5 5.57143 12.5H6.42857C6.90188 12.5 7.28571 12.1162 7.28571 11.6429V7.78571H11.1429C11.6162 7.78571 12 7.40188 12 6.92857V6.07143C12 5.59812 11.6162 5.21429 11.1429 5.21429Z"
                                        fill="white" />
                                </svg>
                                <p class="text-center font-semibold tracking-tight">Add Project</p>
                            </a>
                        </div>
                        <!-- card container -->
                        <div class="flex justify-start items-center gap-4">
                            <!-- cards -->
                            <div class="flex flex-col justify-between items-start p-6 rounded-2xl bg-black/80">
                                <!-- icon -->
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="30" cy="30" r="30" fill="#D9D9D9" />
                                </svg>
                                <!-- Display some number or information -->
                                <p class="text-center text-7xl font-black font-sfprodisplayblack">10</p>
                                <div
                                    class="flex flex-col justify-center items-start text-center font-sfprodisplay tracking-tight">
                                    <p class="text-xl font-semibold">Upcoming</p>
                                    <p class="text-base font-light">Projects</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
