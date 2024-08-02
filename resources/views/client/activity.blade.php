<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>Completed Tasks</x-texts.title>

        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">
            <div class="py-12 text-white">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">

                        <!-- Display Completed Tasks -->
                        <div class="p-5 bg-black">
                            @if ($completedTasks->isEmpty())
                            <p class="text-gray-400">No completed tasks found.</p>
                            @else
                            <ul class="list-disc pl-5">
                                @foreach ($completedTasks as $task)
                                <li class="bg-white text-black p-4 rounded-lg shadow-md mb-4">
                                    <div class="flex flex-col">
                                        <p class="text-xl font-semibold">{{ $task->title }}</p>
                                        <p class="text-sm text-gray-400">Assigned To: {{ $task->assigned_firstname }}
                                            {{ $task->assigned_lastname }}</p>
                                        <p class="text-sm text-gray-300 mt-2">Due Date: {{ $task->due_date }}</p>
                                        <p class="text-sm text-gray-300 mt-2">Priority: {{ $task->priority }}</p>
                                        <p class="text-sm text-gray-300 mt-2">Service Fee: ₱{{ $task->service_fee }}</p>
                                        <p class="text-sm text-gray-300 mt-2">Status: {{ $task->status }}</p>
                                    </div>
                                    <!-- Verify Task and Pay Buttons -->
                                    <div class="mt-4 flex justify-end">
                                        <form action="{{ route('tasks.verify', $task->id) }}" method="POST"
                                            id="verify-form-{{ $task->id }}">
                                            @csrf
                                            @method('POST')
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                                                Verify Task
                                            </button>
                                        </form>

                                        <button
                                            onclick="payTask('{{ $task->id }}', {{ $task->service_fee }}, '{{ $task->title }}')"
                                            class="bg-emeraldlight2 text-white px-4 py-2 rounded-md shadow-md hover:bg-emeraldlight3 ml-2"
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
                </div>
            </div>
        </section>


        <section class="flex flex-col md:flex-row border-b-2 border-slate-300/30 pb-6 mb-4">

            <div class=" py-12 text-white">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">
                        @if (isset($team))
                        <div class="p-5 bg-black">
                            <h2 class="text-2xl font-semibold mb-4">Team Members</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black text-black">
                                @foreach ($team->users->sortBy('name') as $user)
                                <div class="p-4 rounded-lg shadow-lg text-slate-800 bg-zinc-100">
                                    <!-- img -->
                                    <img class="w-full h-32 object-cover rounded-lg"
                                        src="{{ $user->profile_photo_url }}" alt="{{ $user->firstname }}">

                                    <!-- details -->
                                    <h3 class="text-lg font-semibold mt-2">{{ $user->firstname }} {{ $user->lastname }}
                                    </h3>

                                    <!-- Assign Task Button -->
                                    <button class="bg-emerald text-white/90 mt-2 w-full py-2 rounded-md"
                                        onclick="showAssignTaskModal('{{ $user->id }}', '{{ $user->firstname }} {{ $user->lastname }}')">
                                        Assign Task
                                    </button>

                                    <button onclick='showProfileModal({
                                                id: {{ $user->id }},
                                                firstname: "{{ $user->firstname }}",
                                                lastname: "{{ $user->lastname }}",
                                                email: "{{ $user->email }}",
                                                star_rating: {{ $user->star_rating ?? 0 }}, <!-- Default to 0 if star_rating is null -->
                                                pending_tasks: {{ $user->assignedProjects->where(' status', 'pending'
                                        )->count() }},
                                        in_progress_tasks: {{ $user->assignedProjects->where('status',
                                        'in-progress')->count()
                                        }},
                                        completed_tasks: {{ $user->assignedProjects->where('status',
                                        'completed')->count()
                                        }},
                                        total_tasks: {{ $user->assignedProjects->count() }}
                                        })'
                                        class="bg-emerald text-white/90 mt-2 w-full py-2 rounded-md
                                        hover:bg-emerald-600
                                        transition-colors duration-200">
                                        View Profile
                                    </button>

                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>







        @include('modal.task-form')
        @include('modal.view-profile')


    </div>
</x-app-layout>