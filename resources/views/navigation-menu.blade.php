<nav x-data="{ open: false }" class="bg-none">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex text-white font-apercu">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if (auth()->user()->isClient())
                        <a href="{{ route('dashboard') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    @elseif(auth()->user()->isFreelancer())
                        <a href="{{ route('freelancer.home') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (Auth::user()->isClient())
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('client.freelance-display') }}" :active="request()->routeIs('client.freelance-display')">
                            {{ __('Freelancers') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('client.teams') }}" :active="request()->routeIs('client.teams')">
                            {{ __('Teams') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('teams.index') }}" :active="request()->routeIs('teams.index')">
                            {{ __('Team') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('activity.index') }}" :active="request()->routeIs('activity.index')">
                            {{ __('Activity') }}
                        </x-nav-link>
                    @elseif (Auth::user()->isFreelancer())
                        <x-nav-link href="{{ route('freelancer.home') }}" :active="request()->routeIs('freelancer.home')">
                            {{ __('Overview') }}
                        </x-nav-link>

                        {{-- <x-nav-link href="{{ route('freelancer.tasks') }}" :active="request()->routeIs('freelancer.tasks')">
                            {{ __('Task') }}
                        </x-nav-link> --}}

                        <x-nav-link href="{{ route('freelancer.teams') }}" :active="request()->routeIs('freelancer.teams')">
                            {{ __('Teams') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('tasks.index') }}" :active="request()->routeIs('tasks.index')">
                            {{ __('Task') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->firstname }}
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    @if (Auth::user()->currentTeam)
                                        <x-dropdown-link
                                            href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>
                                    @endif

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->firstname }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-xl">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition duration-150 ease-in-out">
                                        {{ Auth::user()->firstname }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            @if (Auth::user()->isFreelancer())
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Team Invitations') }}
                                </div>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-dropdown-link href="{{ route('team.invite') }}">
                                        {{ __('View Invitations') }}
                                    </x-dropdown-link>
                                @endcan
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" @click.away="open = false"
        class="fixed inset-0 z-50 overflow-y-auto bg-white shadow-lg sm:hidden">
        <div class="flex flex-col justify-center h-full px-4 py-6 space-y-6">
            @if (Auth::user()->isClient())
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('client.freelance-display') }}" :active="request()->routeIs('client.freelance-display')">
                    {{ __('Freelancers') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('client.teams') }}" :active="request()->routeIs('client.teams')">
                    {{ __('Teams') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('teams.index') }}" :active="request()->routeIs('teams.index')">
                    {{ __('Team') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('activity.index') }}" :active="request()->routeIs('activity.index')">
                    {{ __('Activity') }}
                </x-responsive-nav-link>
            @elseif (Auth::user()->isFreelancer())
                <x-responsive-nav-link href="{{ route('freelancer.home') }}" :active="request()->routeIs('freelancer.home')">
                    {{ __('Overview') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('freelancer.tasks') }}" :active="request()->routeIs('freelancer.tasks')">
                    {{ __('Task') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('freelancer.teams') }}" :active="request()->routeIs('freelancer.teams')">
                    {{ __('Teams') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('tasks.index') }}" :active="request()->routeIs('tasks.index')">
                    {{ __('Task') }}
                </x-responsive-nav-link>
            @endif

            <!-- Responsive Account Management -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->firstname }}" />
                    <div class="ms-3 text-sm font-medium text-gray-900">{{ Auth::user()->firstname }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    @if (Auth::user()->isFreelancer())
                        <x-responsive-nav-link href="{{ route('team.invite') }}">
                            {{ __('View Invitations') }}
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>
