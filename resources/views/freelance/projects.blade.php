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
                                    <!-- Added role -->
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

                    @if ($tasks->isEmpty())
                        <p class="text-white">No tasks assigned yet.</p>
                    @else
                        <div id="taskContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black">
                            @foreach ($tasks as $task)
                                <div class="task-card p-4 bg-white rounded-lg shadow-md"
                                    data-priority="{{ $task->priority }}" data-due-date="{{ $task->due_date }}">
                                    <h3 class="text-xl font-semibold">{{ $task->title }}</h3>
                                    <p class="text-sm text-gray-500">Due Date:
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y g:i A') }}</p>
                                    <p class="text-sm text-gray-500">Priority: {{ $task->priority }}</p>
                                    <p class="text-sm text-gray-500">Status: {{ $task->status }}</p>
                                    <button
                                        onclick='showTaskModal({
                                            id: {{ $task->id }},
                                            title: "{{ $task->title }}",
                                            description: "{{ $task->description }}",
                                            due_date: "{{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y g:i A') }}",
                                            priority: "{{ $task->priority }}",
                                            service_fee: "{{ $task->service_fee }}",
                                            assigned_to: "{{ $task->assigned_firstname }} {{ $task->assigned_lastname }}",
                                            status: "{{ $task->status }}"
                                        })'
                                        class="bg-blue-500 text-white px-4 py-2 rounded">View Task</button>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function showTaskModal(task) {
            // Populate the modal with task details
            document.getElementById("taskModalTitle").innerText = task.title;
            document.getElementById("taskModalDescription").innerText =
                task.description;
            document.getElementById("taskModalDueDate").innerText = task.due_date;
            document.getElementById("taskModalPriority").innerText = task.priority;
            document.getElementById("taskModalServiceFee").innerText =
                task.service_fee;
            document.getElementById("taskModalAssignedTo").innerText =
                task.assigned_to;
            document.getElementById("taskModalStatus").innerText = task.status;

            // Clear previous action buttons
            const actionsDiv = document.getElementById("taskActions");
            actionsDiv.innerHTML = "";

            // Add appropriate action buttons based on task status
            if (task.status === "pending" || task.status === "in-progress") {
                actionsDiv.innerHTML += `
                    <form action="/freelance/tasks/${task.id}/start" method="POST" class="inline ms-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Start Task</button>
                    </form>
                `;
            }
            if (task.status === "in-progress") {
                actionsDiv.innerHTML += `
                    <form action="/freelance/tasks/${task.id}/complete" method="POST" class="inline ms-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="bg-emerald text-black px-4 py-2 rounded">Complete Task</button>
                    </form>
                `;
            }
            if (task.status === "completed") {
                actionsDiv.innerHTML += `
                    <p class="bg-yellow-300 text-black px-4 py-2 rounded">Waiting for Payment and Verification</p>
                `;
            }

            // Show the modal
            document.getElementById("taskModal").classList.remove("hidden");
        }

        function sortTasks() {
            const sortFilter = document.getElementById('sortFilter').value;
            const container = document.getElementById('taskContainer');
            const tasks = Array.from(container.querySelectorAll('.task-card'));

            tasks.sort((a, b) => {
                const priorityOrder = {
                    'low': 1,
                    'medium': 2,
                    'high': 3
                };
                const dueDateA = new Date(a.getAttribute('data-due-date'));
                const dueDateB = new Date(b.getAttribute('data-due-date'));

                switch (sortFilter) {
                    case 'priority-asc':
                        return priorityOrder[a.getAttribute('data-priority')] - priorityOrder[b
                            .getAttribute('data-priority')];
                    case 'priority-desc':
                        return priorityOrder[b.getAttribute('data-priority')] - priorityOrder[a
                            .getAttribute('data-priority')];
                    case 'due-date-asc':
                        return dueDateA - dueDateB;
                    case 'due-date-desc':
                        return dueDateB - dueDateA;
                    default:
                        return 0;
                }
            });

            // Append sorted tasks to the container
            tasks.forEach(task => container.appendChild(task));
        }

        document.getElementById('sortFilter').addEventListener('change', sortTasks);

        // Make the function globally accessible
        window.showTaskModal = showTaskModal;
    });
</script>
