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

    <section class="">
        <h2>Project Summary</h2>
        <p>Summary of project details, tasks, and members</p>
        <div class="grid grid-cols-3 gap-4 mt-6">
            <x-card.dash-card title="Pending Tasks" count="{{ $pendingCount }}"></x-card.dash-card>
            <x-card.dash-card title="In Progress" count="{{ $pendingCount }}"></x-card.dash-card>
            <x-card.dash-card title="Completed" count="{{ $pendingCount }}"></x-card.dash-card>
        </div>
    </section>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">
                @if (isset($team))
                    <!-- Team Members Card View -->
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
                                            star_rating: {{ $user->star_rating }},
                                            pending_tasks: {{ $user->assignedProjects->where('status', 'pending')->count() }},
                                            in_progress_tasks: {{ $user->assignedProjects->where('status', 'in-progress')->count() }},
                                            completed_tasks: {{ $user->assignedProjects->where('status', 'completed')->count() }},
                                            total_tasks: {{ $user->assignedProjects->count() }}
                                        })'
                                        class="bg-emerald text-white/90 mt-2 w-full py-2 rounded-md">
                                        View Profile
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Default Dashboard -->
                    <div class="p-5 bg-slate-800">
                        <div class="flex justify-between items-center">
                            <div
                                class="flex flex-col justify-center items-start gap-1 font-sfprodisplay tracking-tight">
                                <h1 class="text-4xl font-semibold">Project Summary</h1>
                                <p class="text-base font-extralight">Hola soy dora</p>
                            </div>
                            <a href="/" class="flex justify-between items-center">
                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.1429 5.21429H7.28571V1.35714C7.28571 0.883839 6.90188 0.5 6.42857 0.5H5.57143C5.09812 0.5 4.71429 0.883839 4.71429 1.35714V5.21429H0.857143C0.383839 5.21429 0 5.59812 0 6.07143V6.92857C0 7.40188 0.383839 7.78571 0.857143 7.78571H4.71429V11.6429C4.71429 12.1162 5.09812 12.5 5.57143 12.5H6.42857C6.90188 12.5 7.28571 12.1162 7.28571 11.6429V7.78571H11.1429C11.6162 7.78571 12 7.40188 12 6.92857V6.07143C12 5.59812 11.6162 5.21429 11.1429 5.21429Z"
                                        fill="white" />
                                </svg>
                                <p class="text-center font-semibold tracking-tight">Add Project</p>
                            </a>
                        </div>
                        <div class="flex justify-start items-center gap-4">
                            <div class="flex flex-col justify-between items-start p-6 rounded-2xl bg-black/80">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="30" cy="30" r="30" fill="#D9D9D9" />
                                </svg>
                                <p class="text-center text-7xl font-black font-sfprodisplayblack">10</p>
                                <div
                                    class="flex flex-col justify-center items-start text-center font-sfprodisplay tracking-tight">
                                    <p class="text-xl font-semibold">Upcoming</p>
                                    <p class="text-base font-light">Projects</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

@include('modal.task-form')
@include('modal.view-profile')

@include('modal.task-form')
@include('modal.view-profile')


@include('modal.task-form')

{{--
<script src="{{ asset('js/taskModal.js') }}"></script> --}}
