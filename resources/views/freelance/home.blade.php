<!-- resources/views/freelance/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Freelance Dashboard
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-800 p-4 rounded-lg bg-lightgray">
                <h3 class="text-lg font-semibold">Pending Tasks</h3>
                <p class="text-2xl">{{ $pendingCount }}</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg  bg-lightgray">
                <h3 class="text-lg font-semibold">In-Progress Tasks</h3>
                <p class="text-2xl">{{ $inProgressCount }}</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg  bg-lightgray">
                <h3 class="text-lg font-semibold">Completed Tasks</h3>
                <p class="text-2xl">{{ $completedCount }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
