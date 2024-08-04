<x-app-layout>
    <div class="m-10 text-white">
        {{-- <x-texts.title>
            @if (isset($team))
            {{ $team->name }} Dashboard
            @else

            @endif
        </x-texts.title> --}}

        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">
            <div class="flex flex-col w-full md:w-3/4">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-semibold">Project Summary</h2>
                    <p class="text-white/50">Summary of project details, tasks, notifications, and calendar</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 mt-6 mr-10 *:bg-olivegreen/60">
                    <x-card.dash-card title="Pending" count="{{ $pendingCount }}"></x-card.dash-card>
                    <x-card.dash-card title="In Progress" count="{{ $inProgressCount }}"></x-card.dash-card>
                    <x-card.dash-card title="Completed" count="{{ $completedCount }}"></x-card.dash-card>

                    {{-- @if (isset($team))
                    <!-- Team Members Card View -->
                    @endif --}}
                </div>
            </div>
            <div class="flex flex-col w-full md:w-1/4 mt-6 md:mt-0">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-semibold">Notifications</h2>
                    <p class="text-white/50">Completed tasks awaiting for verification</p>
                </div>
                <div class="flex flex-col gap-3 mt-6 *:bg-lightgray/60 overflow-y-auto max-h-60 rounded-md">
                    @forelse ($completedTasks as $task)
                        <div class="bg-white p-10 rounded-lg shadow-md mb-4 text-white">
                            <p class="text-xl font-semibold">{{ $task['title'] }}</p>
                            <p class="text-sm font-gray-600">Assigned to: {{ $task['assigned_firstname'] }}
                                {{ $task['assigned_lastname'] }}</p>
                            <p class="text-sm text-gray-300 mt-2">Service Fee: ₱{{ $task['service_fee'] }}</p>
                            <p class="text-sm text-gray-600 mt-2">Due Date: {{ $task['due_date']->format('F j, Y') }}
                            </p>
                            <p class="text-sm text-gray-300 mt-2">Status:{{ $task['status'] }}</p>
                        </div>
                    @empty
                        <div>No completed tasks available.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="flex flex-col md:flex-row  pb-4 m-4">
            <div class="flex flex-col w-full md:w-3/4">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-semibold">Project Calendar</h2>
                    <p class="text-white/50">Check your project due dates here</p>
                </div>
                <div class="flex flex-col mt-6 mr-0 md:mr-10">
                    <div id="calendar" class="w-full"></div>
                </div>
            </div>
            <div class="flex flex-col w-full md:w-1/4 mt-6 md:mt-0">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-semibold">Task Activity</h2>
                    <p class="text-white/50">Update for all in-progress tasks</p>
                </div>
                <div class="flex flex-col gap-4 mt-6 *:bg-lightgray/60 overflow-y-auto max-h-60 rounded-md">
                    @forelse ($inProgressTasks as $task)
                        <div class="bg-white p-10 rounded-lg shadow-md mb-4 text-white">
                            <p class="text-xl font-semibold">{{ $task['title'] }}</p>
                            <p class="text-sm text-gray-600">Assigned to: {{ $task['assigned_firstname'] }}
                                {{ $task['assigned_lastname'] }}</p>
                            <p class="text-sm text-gray-600 mt-2">Service Fee: ₱{{ $task['service_fee'] }}</p>
                            <p class="text-sm text-gray-600 mt-2">Due Date: {{ $task['due_date']->format('F j, Y') }}
                            </p>
                            <p class="text-sm text-gray-600 mt-2">Priority: {{ $task['priority'] }}</p>
                        </div>
                    @empty
                        <div class="text-white">No in-progress tasks available.</div>
                    @endforelse
                </div>

            </div>
        </section>
    </div>
</x-app-layout>

@include('modal.task-form')
@include('modal.view-profile')
