<x-app-layout>
    <div class="m-10 text-white">
        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">
            <div class="flex flex-col w-full">
                <div class="flex flex-col">
                    <h2 class="text-2xl text-white font-semibold">@if (isset($team))
                        {{ $team->name }} Dashboard
                        @else
                        Freelance Dashboard
                        @endif</h2>
                    <p class="text-white/50">Summary of project details, tasks, notifications, and calendar</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 *:bg-olivegreen/60 text-white">
                    <x-card.dash-card title="Pending" count="{{ $pendingCount }}"></x-card.dash-card>
                    <x-card.dash-card title="In Progress" count="{{ $inProgressCount }}"></x-card.dash-card>
                    <x-card.dash-card title="Completed" count="{{ $completedCount }}"></x-card.dash-card>
                </div>
            </div>
        </section>

        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">
            <div class="flex flex-col w-full">
                <h2 class="text-2xl text-white font-semibold">Invitations</h2>
                <a href=" {{ route('team.invite') }}" class="text-emerald hover:text-emeraldlight3 hover:scale-105">
                    {{ __('View team invitations') }}</a>
            </div>
        </section>

        <section class="flex flex-col">
            <div class="bg-black overflow-hidden shadow-xl">

                <!-- Calendar Container -->
                <div id="calendar" class="text-white"></div>
            </div>
        </section>
    </div>
</x-app-layout>