<!-- resources/views/freelance/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Freelance Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col w-full md:w-3/4">
                    <div class="flex flex-col">
                        <h2 class="text-2xl text-white font-semibold">Project Summary</h2>
                        <p class="text-white/50">Summary of project details, tasks, notifications, and calendar</p>
                    </div>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 mt-6 mr-10 mb-10 *:bg-olivegreen/60 text-white">
                        <x-card.dash-card title="Pending" count="{{ $pendingCount }}"></x-card.dash-card>
                        <x-card.dash-card title="In Progress" count="{{ $inProgressCount }}"></x-card.dash-card>
                        <x-card.dash-card title="Completed" count="{{ $completedCount }}"></x-card.dash-card>
                    </div>
                </div>
                <!-- Calendar Container -->
                <div id="calendar" class="text-white"></div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
