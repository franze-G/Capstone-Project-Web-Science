<x-app-layout>

    <div class="m-10 text-white">
        <!-- Display success message if available -->
        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
        @endif
        <x-texts.title>Completed Tasks</x-texts.title>

        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">
            <div class="flex flex-col">
                <div class="w-full mx-auto sm:px-6 lg:px-8">
                    <!-- Display Completed Tasks -->
                    @if ($completedTasks->isEmpty())
                    <p class="text-gray-400">No completed tasks found.</p>
                    @else
                    <ul class="list-disc pl-5">
                        @foreach ($completedTasks as $task)
                        <li class="bg-emerald/35 text-white p-4 rounded-lg shadow-md mb-4 list-none">
                            <div class="flex flex-col">
                                <p class="text-xl font-semibold">{{ $task->title }}</p>
                                <p class="text-sm text-gray-400">Assigned To:
                                    {{ $task->assigned_firstname }}
                                    {{ $task->assigned_lastname }}</p>
                                <p class="text-sm text-gray-300 mt-2">Due Date: {{ $task->due_date }}
                                </p>
                                <p class="text-sm text-gray-300 mt-2">Priority: {{ $task->priority }}
                                </p>
                                <p class="text-sm text-gray-300 mt-2">Service Fee:
                                    ₱{{ $task->service_fee }}</p>
                                <p class="text-sm text-gray-300 mt-2">Status: {{ $task->status }}</p>
                            </div>
                            <!-- Verify Task and Pay Buttons -->
                            <div class="mt-4 flex justify-end">
                                <form action="{{ route('tasks.verify', $task->id) }}" method="POST"
                                    id="verify-form-{{ $task->id }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="bg-olivegreen text-white px-4 py-2 rounded-md shadow-md hover:bg-emerald">
                                        Verify Task
                                    </button>
                                </form>

                                <button
                                    onclick="payTask('{{ $task->id }}', {{ $task->service_fee }}, '{{ $task->title }}')"
                                    class="bg-olivegreen text-white px-4 py-2 rounded-md shadow-md hover:bg-emerald ml-2"
                                    style="display: none;" id="pay-button-{{ $task->id }}">
                                    Pay
                                </button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

        </section>

        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">
            <div class="flex flex-col ">
                <div class="w-full mx-auto sm:px-6 lg:px-8">
                    {{-- @if (isset($team)) --}}
                    <div class="p-5 bg-black">
                        <h2 class="text-2xl font-semibold mb-4 ">Team Members</h2>
                        @if ($teamMembers->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
                            @foreach ($teamMembers as $member)
                            <div class="p-4 rounded-xl shadow-lg bg-emerald/35 ">
                                <!-- Profile Image -->
                                <img src="{{ $member->profile_photo_url }}"
                                    alt="{{ $member->firstname }} {{ $member->lastname }}"
                                    class="w-full h-32 object-cover rounded-lg mb-2">
                                <!-- Name -->
                                <h3 class="text-lg font-semibold">{{ $member->firstname }}
                                    {{ $member->lastname }}</h3>

                                <!-- Buttons -->
                                <button class="bg-emerald py-2 px-4 rounded mt-2"
                                    onclick="showAssignTaskModal('{{ $member->id }}', '{{ $member->firstname }} {{ $member->lastname }}')">
                                    Assign Task
                                </button>

                                <button onclick='showProfileModal({
                                                id: {{ $member->id }},
                                                firstname: "{{ $member->firstname }}",
                                                lastname: "{{ $member->lastname }}",
                                                email: "{{ $member->email }}",
                                                position: "{{ $member->position }}",
                                                star_rating: {{ $member->star_rating ?? 0 }},
                                                pending_tasks: {{ $member->assignedProjects->where(' status', 'pending'
                                    )->count() }},
                                    in_progress_tasks: {{ $member->assignedProjects->where('status',
                                    'in-progress')->count() }},
                                    completed_tasks: {{ $member->assignedProjects->where('status',
                                    'completed')->count() }},
                                    total_tasks: {{ $member->assignedProjects->count() }}
                                    })'
                                    class="bg-emerald text-white py-2 px-4 rounded mt-2 hover:bg-emerald-600
                                    transition-colors duration-200">
                                    View Profile
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>No team members found.</p>
                        @endif
                    </div>
                    {{-- @endif --}}
                </div>
            </div>
        </section>
    </div>
</x-app-layout>


@include('modal.task-form')
@include('modal.view-profile')