<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (auth()->user()->currentTeam)
                {{ auth()->user()->currentTeam->name }} Dashboard
            @else
                {{ __('Task Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">

                @if (auth()->user()->currentTeam)
                    <div class="p-5 bg-slate-800">
                        <h2 class="text-2xl font-bold mb-4">Team Owner</h2>
                        <div class="col-span-6">
                            <div class="flex items-center mt-2">
                                <img class="w-12 h-12 rounded-full object-cover"
                                    src="{{ auth()->user()->currentTeam->owner->profile_photo_url }}"
                                    alt="{{ auth()->user()->currentTeam->owner->firstname }}">
                                <div class="ms-4 leading-tight">
                                    <div class="text-gray-900 font-semibold">
                                        {{ auth()->user()->currentTeam->owner->firstname }}
                                        {{ auth()->user()->currentTeam->owner->lastname }}
                                    </div>
                                    <div class="text-gray-700 text-sm mt-1">
                                        {{ ucfirst(auth()->user()->currentTeam->owner->role) }}
                                    </div>

                                    <div class="text-gray-700 text-sm">{{ auth()->user()->currentTeam->owner->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-5 bg-black text-black">
                    <h2 class="text-2xl font-semibold mb-4">Projects</h2>

                    <!-- Dropdown Filter -->
                    <div class="mb-4">
                        <label for="sortFilter" class="block text-white text-sm font-medium mb-2">Sort by:</label>
                        <select id="sortFilter" class="bg-lightgray text-sm text-black px-4 py-2 rounded">
                            <option value="">Select Sort Option</option>
                            <option value="priority-asc">Priority: Lowest to Highest</option>
                            <option value="priority-desc">Priority: Highest to Lowest</option>
                            <option value="due-date-asc">Due Date: Earliest to Latest</option>
                            <option value="due-date-desc">Due Date: Latest to Earliest</option>
                        </select>
                    </div>

                    @php
                        // Filter tasks based on the team owner assignment
                        $filteredTasks = auth()->user()->currentTeam
                            ? $tasks->filter(fn($task) => $task->created_by === auth()->user()->currentTeam->owner->id)
                            : $tasks;
                    @endphp

                    @if ($filteredTasks->isEmpty())
                        <p class="text-white">No tasks assigned yet.</p>
                    @else
                        <div id="taskContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black">
                            @foreach ($filteredTasks as $task)
                                <div class="p-4 rounded-lg shadow-lg text-slate-800 bg-zinc-100 task-card"
                                    data-priority="{{ $task->priority }}" data-due-date="{{ $task->due_date }}">
                                    <h3 class="text-lg font-semibold mt-2">{{ $task->title }}</h3>
                                    <p class="text-slate-600">Due Date:
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y \a\t g:i A') }}</p>
                                    <p class="text-slate-600">Assigned To: {{ $task->assigned_firstname }}
                                        {{ $task->assigned_lastname }}</p>
                                    <p class="mt-2">Priority: <span class="font-semibold">
                                            {{ $task->priority }}</span></p>
                                    <button
                                        onclick='showTaskModal({
                                            id: {{ $task->id }},
                                            title: "{{ $task->title }}",
                                            description: "{{ $task->description }}",
                                            due_date: "{{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y \a\t g:i A') }}",
                                            priority: "{{ $task->priority }}",
                                            service_fee: "{{ $task->service_fee }}",
                                            assigned_to: "{{ $task->assigned_firstname }} {{ $task->assigned_lastname }}",
                                            status: "{{ $task->status }}"
                                        })'
                                        class="bg-emerald text-white/90 mt-2 w-full py-2 rounded-md">View Task</button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @include('modal.task-modal')
</x-app-layout>
