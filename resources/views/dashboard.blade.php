<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (isset($team))
                {{ $team->name }} Dashboard
            @else
                {{ __('Client Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <x-texts.title>Overview</x-texts.title>

    <section class="text-white">
        <h2>Project Summary</h2>
        <p>Summary of project details, tasks, and members</p>
        <div class="grid grid-cols-3 gap-4 mt-6">
            <x-card.dash-card title="Pending Tasks" count="{{ $pendingCount }}"></x-card.dash-card>
            <x-card.dash-card title="In Progress" count="{{ $inProgressCount }}"></x-card.dash-card>
            <x-card.dash-card title="Completed" count="{{ $completedCount }}"></x-card.dash-card>

            {{-- @if (isset($team))
                <!-- Team Members Card View -->
            @endif --}}
        </div>
    </section>

    <div class="py-12 text-white">
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

                                    <button
                                        onclick='showProfileModal({
                                        id: {{ $user->id }},
                                        firstname: "{{ $user->firstname }}",
                                        lastname: "{{ $user->lastname }}",
                                        email: "{{ $user->email }}",
                                        star_rating: {{ $user->star_rating ?? 0 }}, <!-- Default to 0 if star_rating is null -->
                                        pending_tasks: {{ $user->assignedProjects->where('status', 'pending')->count() }},
                                        in_progress_tasks: {{ $user->assignedProjects->where('status', 'in-progress')->count() }},
                                        completed_tasks: {{ $user->assignedProjects->where('status', 'completed')->count() }},
                                        total_tasks: {{ $user->assignedProjects->count() }}
                                    })'
                                        class="bg-emerald text-white/90 mt-2 w-full py-2 rounded-md hover:bg-emerald-600 transition-colors duration-200">
                                        View Profile
                                    </button>

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif


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
