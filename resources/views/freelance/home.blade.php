<!-- resources/views/freelance/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Freelance Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Pending Projects</h3>
                            <p class="text-2xl text-blue-600">{{ $pendingCount }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-yellow-800">In-Progress Projects</h3>
                            <p class="text-2xl text-yellow-600">{{ $inProgressCount }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">Completed Projects</h3>
                            <p class="text-2xl text-green-600">{{ $completedCount }}</p>
                        </div>
                    </div>

                    <!-- Calendar Container -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid'],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                events: @json(
                    $tasks->map(function ($task) {
                            return [
                                'title' => $task->title,
                                'start' => $task->due_date,
                                'color' => $task->priority === 'High' ? 'red' : 'blue', // Color based on priority
                            ];
                        })->toArray()),
            });
            calendar.render();
        });
    </script> --}}
</x-app-layout>
