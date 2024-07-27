<x-app-layout>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">
                @if (isset($team))
                    <!-- Team Members Card View -->
                    <div class="p-5 bg-black">
                        <h2 class="text-2xl font-semibold mb-4">Team Members</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black text-black">
                            @foreach ($team->users->sortBy('name') as $user)
                                <div class="bg-white p-4 rounded-lg shadow-md opacity-90">
                                    <div class="flex items-center">
                                        <img class="w-16 h-16 rounded-full object-cover"
                                            src="{{ $user->profile_photo_url }}" alt="{{ $user->firstname }}">
                                        <div class="ms-4">
                                            <p class="text-xl font-semibold">{{ $user->firstname }}
                                                {{ $user->lastname }}</p>
                                            <p class="text-sm text-gray-400">{{ $user->email }}</p>
                                            <p class="text-sm text-gray-300 mt-2">
                                                Tasks Assigned:
                                                {{ $user->assignedProjects->where('created_by', auth()->user()->id)->count() }}
                                            </p>
                                            @if ($user->assignedProjects->where('created_by', auth()->user()->id)->count() > 0)
                                                <p class="text-sm text-gray-300 mt-1">
                                                    Pending:
                                                    {{ $user->assignedProjects->where('status', 'pending')->where('created_by', auth()->user()->id)->count() }}
                                                </p>
                                                <p class="text-sm text-gray-300 mt-1">
                                                    In-Progress:
                                                    {{ $user->assignedProjects->where('status', 'in-progress')->where('created_by', auth()->user()->id)->count() }}
                                                </p>
                                                <p class="text-sm text-gray-300 mt-1">
                                                    Completed:
                                                    {{ $user->assignedProjects->where('status', 'completed')->where('created_by', auth()->user()->id)->count() }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-4 flex items-center">
                                        @if (Gate::check('updateTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                                            <button class="text-sm text-gray-400 underline"
                                                onclick="manageRole('{{ $user->id }}')">
                                                {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                            </button>
                                        @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                                            <div class="text-sm text-gray-400">
                                                {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                            </div>
                                        @endif

                                        <!-- Assign Task Button -->
                                        <button class="ms-2 text-sm text-blue-500 underline"
                                            onclick="showAssignTaskModal('{{ $user->id }}', '{{ $user->firstname }} {{ $user->lastname }}')">
                                            Assign Task
                                        </button>

                                    </div>
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

{{-- <script src="{{ asset('js/taskModal.js') }}"></script> --}}
