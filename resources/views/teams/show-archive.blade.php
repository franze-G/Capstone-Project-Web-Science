<!-- resources/views/teams/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Teams') }}
    </x-slot>

    <div class="container mx-auto p-6 text-white">
        <!-- Active Teams -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold ">{{ __('Active Teams') }}</h1>
            @if ($teams->isEmpty())
            <p class="">{{ __('No active teams found.') }}</p>
            @else
            <ul>
                @foreach ($teams as $team)
                <li class="">{{ $team->name }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Archived Teams -->
        <div>
            <h1 class="text-2xl font-bold text-white">{{ __('Archived Teams') }}</h1>
            @if ($archivedTeams->isEmpty())
            <p class="text-white">{{ __('No archived teams found.') }}</p>
            @else
            <ul>
                @foreach ($archivedTeams as $team)
                <li>{{ $team->name }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</x-app-layout>