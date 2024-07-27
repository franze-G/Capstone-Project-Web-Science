<x-app-layout>
  <div class="m-10 text-white">
    <x-texts.title>Team Management</x-texts.title>
    <div class="flex flex-col border-slate-300/30">
      <!-- Team Switcher -->
      <section class="mb-6">
        <!-- Team Name -->
        <div class="text-2xl font-bold mb-4">
          @if(auth()->user()->currentTeam)
          Current Team: <span class="text-emerald">{{ auth()->user()->currentTeam->name }}</span>
          <div class="flex flex-wrap space-y-2 sm:space-y-0">
            @if (Auth::user()->isClient() || Auth::user()->isFreelancer())
            @php
            $teams = Auth::user()->isClient() ? Auth::user()->allTeams()->where('archived', false) :
            Auth::user()->teams->where('archived', false);
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
      </section>

      <!-- Team Owner -->
      <section class="mb-6">
        @if(auth()->user()->currentTeam)
        <h2 class="text-2xl font-semibold mb-4">{{ __('Team Owner') }}</h2>
        <div class="flex items-center mt-2">
          <img class="w-12 h-12 rounded-full object-cover"
            src="{{ auth()->user()->currentTeam->owner->profile_photo_url }}"
            alt="{{ auth()->user()->currentTeam->owner->firstname }}">
          <div class="ms-4 leading-tight">
            <div class="text-gray-900">{{ auth()->user()->currentTeam->owner->firstname }}</div>
            <div class="text-gray-700 text-sm">{{ auth()->user()->currentTeam->owner->email }}
            </div>
          </div>
        </div>
        @endif
      </section>

    </div>
  </div>

  <!-- eto yung dropdown to be fixed inside the view na mismo -->
  @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
  <div class="ml-3 relative text-black">
    <x-dropdown align="right" width="60">
      <x-slot name="trigger">
        <span class="inline-flex rounded-xl">
          <button type="button"
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
            {{ Auth::user()->firstname }}
            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
            </svg>
          </button>
        </span>
      </x-slot>

      <x-slot name="content">
        @if (Auth::user()->isClient() || Auth::user()->isFreelancer())
        <div class="w-60">
          <!-- Team Management -->
          <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Manage Team') }}
          </div>

          <!-- Team Settings -->
          @if (Auth::user()->currentTeam)
          @if (
          (Auth::user()->isClient() && Auth::user()->allTeams()->where('archived',
          false)->isEmpty()) ||
          (Auth::user()->isFreelancer() && Auth::user()->teams->where('archived',
          false)->isEmpty()))
          <x-dropdown-link class="opacity-50 cursor-not-allowed">
            {{ __('Team Settings') }}
          </x-dropdown-link>
          @else
          <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
            {{ __('Team Settings') }}
          </x-dropdown-link>
          @endif
          @endif

          <!-- Only show "Create New Team" for users who can create teams -->
          @if (Auth::user()->isClient() && auth()->user()->can('create',
          Laravel\Jetstream\Jetstream::newTeamModel()))
          <x-dropdown-link href="{{ route('teams.create') }}">
            {{ __('Create New Team') }}
          </x-dropdown-link>
          @endif

          <!-- Archive Teams for Clients -->
          @if (Auth::user()->isClient() && auth()->user()->can('create',
          Laravel\Jetstream\Jetstream::newTeamModel()))
          <x-dropdown-link href="{{ route('teams.index') }}">
            {{ __('Archive Teams') }}
          </x-dropdown-link>
          @endif

          <!-- Team Invitations for Freelancers -->
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

        </div>
        @endif
      </x-slot>
    </x-dropdown>
  </div>
  @endif
  </div>
</x-app-layout>