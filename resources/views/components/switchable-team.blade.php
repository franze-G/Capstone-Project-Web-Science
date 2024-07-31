@props(['team', 'component' => 'buttons.nav-button'])

<form method="POST" action="{{ route('current-team.update') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="team_id" value="{{ $team->id }}">
    <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

    <x-dynamic-component :component="$component" href="#" x-on:click.prevent="$root.submit();">
        <div class="flex items-center">
            <div
                class="{{ Auth::user()->currentTeam && Auth::user()->currentTeam->id === $team->id ? ' text-emerald hover:no-underline' : '' }} truncate">
                {{ $team->name }}
            </div>
        </div>
    </x-dynamic-component>
</form>
