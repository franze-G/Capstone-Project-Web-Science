<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (auth()->user()->currentTeam)
                <!-- Display team name if the user is on a team -->
                {{ auth()->user()->currentTeam->name }} Dashboard
            @else
                <!-- Display default client dashboard text -->
                {{ __('Task Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">
                @if (auth()->user()->currentTeam)
                    <!-- Display Team Owner Information -->
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
                                    <div class="text-gray-700 text-sm">{{ auth()->user()->currentTeam->owner->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-5 bg-white text-black">
                    <h2 class="text-2xl font-semibold mb-4">Projects</h2>
                    @if ($tasks->isEmpty())
                        <!-- Display message if no tasks are assigned -->
                        <p class="text-gray-500">No tasks assigned yet.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-white">
                            @foreach ($tasks as $task)
                                @if (auth()->user()->currentTeam)
                                    <!-- Show only tasks assigned by the team owner -->
                                    @if ($task->created_by === auth()->user()->currentTeam->owner->id)
                                        <div class="p-4 bg-lightgray rounded-lg shadow-md">
                                            <h3 class="text-xl font-semibold">{{ $task->title }}</h3>
                                            <p class="text-sm text-gray-500">Due Date:
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y g:i A') }}</p>
                                            <p class="text-sm text-gray-500">Priority: {{ $task->priority }}</p>
                                            <p class="text-sm text-gray-500">Status: {{ $task->status }}</p>
                                            <!-- View Task Button -->
                                            <button onclick="showTaskModal({{ $task->id }})"
                                                class="bg-blue-500 text-white px-4 py-2 rounded">View Task</button>
                                        </div>
                                    @endif
                                @else
                                    <!-- Show all tasks if no team is selected -->
                                    <div class="p-4 bg-lightgray rounded-lg shadow-md">
                                        <h3 class="text-xl font-semibold">{{ $task->title }}</h3>
                                        <p class="text-sm text-gray-500">Due Date:
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y g:i A') }}</p>
                                        <p class="text-sm text-gray-500">Priority: {{ $task->priority }}</p>
                                        <p class="text-sm text-gray-500">Status: {{ $task->status }}</p>
                                        <!-- View Task Button -->
                                        <button onclick="showTaskModal({{ $task->id }})"
                                            class="bg-blue-500 text-white px-4 py-2 rounded">View Task</button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Include the Task Modal -->
    @include('modal.task-modal')
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        function showTaskModal(taskId) {
            fetch(`/tasks/${taskId}`)
                .then((response) => response.json())
                .then((task) => {
                    // Populate the modal with task details
                    document.getElementById("taskModalTitle").innerText =
                        task.title;
                    document.getElementById("taskModalDescription").innerText =
                        task.description;
                    document.getElementById("taskModalDueDate").innerText =
                        task.due_date;
                    document.getElementById("taskModalPriority").innerText =
                        task.priority;
                    document.getElementById("taskModalServiceFee").innerText =
                        task.service_fee;
                    document.getElementById("taskModalAssignedTo").innerText =
                        task.assigned_firstname + " " + task.assigned_lastname;
                    document.getElementById("taskModalStatus").innerText =
                        task.status;

                    // Get the actions container
                    const actionsDiv = document.getElementById("taskActions");

                    // Clear previous actions
                    actionsDiv.innerHTML = "";

                    // Add buttons based on task status
                    if (
                        task.status === "pending" ||
                        task.status === "in-progress"
                    ) {
                        actionsDiv.innerHTML += `
                        <!-- Start Task Form -->
                        <form action="{{ route('tasks.start', $task->id) }}" method="POST" class="inline ms-2">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Start Task</button>
                        </form>
                    `;
                    }
                    if (task.status === "in-progress") {
                        actionsDiv.innerHTML += `
                     <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="inline ms-2">
                        @csrf
                        <button type="submit" class="bg-emerald text-black px-4 py-2 rounded">Complete Task</button>
                    </form>
                    `;
                    }

                    // Show the modal
                    document.getElementById("taskModal").classList.remove("hidden");
                })
                .catch((error) => {
                    console.error("Error fetching task details:", error);
                });
        }

        // Make the function globally accessible
        window.showTaskModal = showTaskModal;
    });
</script>
