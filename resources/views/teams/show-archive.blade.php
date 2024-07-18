<!-- resources/views/teams/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Teams') }}
    </x-slot>

    <div class="container mx-auto p-6 text-gray-900 bg-gray-100 text-white">
        <!-- Active Teams -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Active Teams') }}</h1>
            @if ($teams->isEmpty())
            <p class="text-gray-600">{{ __('No active teams found.') }}</p>
            @else
            <ul class="list-disc list-inside">
                @foreach ($teams as $team)
                <li class="py-2">{{ $team->name }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Archived Teams -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Archived Teams') }}</h1>
            @if ($archivedTeams->isEmpty())
            <p class="text-gray-600">{{ __('No archived teams found.') }}</p>
            @else
            <ul class="list-disc list-inside">
                @foreach ($archivedTeams as $team)
                <li class="py-2 flex items-center justify-between">
                    <span>{{ $team->name }}</span>
                    <form action="{{ route('teams.recover', $team->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-xl hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                            {{ __('Recover') }}
                        </button>
                    </form>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</x-app-layout>