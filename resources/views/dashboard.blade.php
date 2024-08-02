<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>
            @if (isset($team))
            {{ $team->name }} Dashboard
            @else
            {{ __('Overview') }}
            @endif
        </x-texts.title>

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
                    <p class="text-white/50">Tasks update and such</p>
                </div>
                <div class="flex flex-col gap-3 mt-6 *:bg-emerald/25 overflow-y-auto max-h-60">
                    {{-- @foreach ($notifications as $notification) --}}
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    {{-- @endforeach --}}
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
                    <h2 class="text-2xl font-semibold">Your Feedbacks</h2>
                    <p class="text-white/50">Your freelance feed and reports</p>
                </div>
                <div class="flex flex-col gap-3 mt-6 *:bg-zinc-500 overflow-y-auto max-h-60">
                    {{-- @foreach ($notifications as $notification) --}}
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    <div>Make a notification component</div>
                    {{-- @endforeach --}}
                </div>
            </div>
        </section>


    </div>

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
                            <img class="w-full h-32 object-cover rounded-lg" src="{{ $user->profile_photo_url }}"
                                alt="{{ $user->firstname }}">

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
                                in_progress_tasks: {{ $user->assignedProjects->where('status', 'in-progress')->count()
                                }},
                                completed_tasks: {{ $user->assignedProjects->where('status', 'completed')->count() }},
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
    @include('modal.task-form')
    @include('modal.view-profile')
</x-app-layout>