<!-- resources/views/teams/index.blade.php -->
<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>Manage Team</x-texts.title>

        <!-- Active Teams -->
        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">
            <div class="flex flex-col w-full">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-semibold">Active Teams</h2>
                    @if ($teams->isEmpty())
                    <h2>No active teams found.</h2>
                    @else
                    <p class="text-white/50">Summary of project details, tasks, notifications, and calendar</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 mt-6 mr-10 *:bg-olivegreen/60">
                    @foreach ($teams as $team)
                    <div>{{$team->name}}</div>
                    @endforeach
                </div>
                @endif
            </div>
        </section>

        <!-- Archived Teams -->
        <section class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-semibold">Archived Teams</h2>
                    @if ($archivedTeams->isEmpty())
                    <h2>No archived teams found.</h2>
                    @else
                    <p class="text-white/50">Summary of project details, tasks, notifications, and calendar</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 mt-6 mr-10 *:bg-olivegreen/60">
                    @foreach ($archivedTeams as $team)
                    <div>{{$team->name}}</div>
                    <form action="{{ route('teams.recover', $team->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-xl hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                            {{ __('Recover') }}
                        </button>
                    </form>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
    </div>
</x-app-layout>