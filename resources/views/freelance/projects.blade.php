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
                                        {{ auth()->user()->currentTeam->owner->lastname }}</div>
                                    <div class="text-gray-700 text-sm">{{ auth()->user()->currentTeam->owner->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-5 bg-white text-black">
                    <h2 class="text-2xl font-semibold mb-4">Your Tasks</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-white">
                        @foreach ($tasks as $task)
                            @if (auth()->user()->currentTeam)
                                <!-- Show only tasks assigned by the team owner -->
                                @if ($task->created_by === auth()->user()->currentTeam->owner->id)
                                    <div class="p-4 bg-lightgray rounded-lg shadow-md">
                                        <h3 class="text-xl font-semibold">{{ $task->title }}</h3>
                                        <p class="text-gray-400">{{ $task->description }}</p>
                                        <p class="text-sm text-gray-500">Due Date:
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }} at
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('g:i A') }}</p>
                                        <p class="text-sm text-gray-500">Priority: {{ $task->priority }}</p>
                                        <p class="text-sm text-gray-500">Service Fee: {{ $task->service_fee }}</p>
                                        <p class="text-sm text-gray-500">Assigned to: {{ $task->assigned_firstname }}
                                            {{ $task->assigned_lastname }}</p>
                                        <!-- Task Status and Actions -->
                                        <p class="text-sm text-gray-500">Status: {{ $task->status }}</p>
                                        @if ($task->status === 'pending')
                                            <form action="{{ route('tasks.start', $task->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded">Start Task</button>
                                            </form>
                                        @elseif($task->status === 'in-progress')
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-emeraldlight2 text-bl px-4 py-2 rounded">Complete
                                                    Task</button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <!-- Show all tasks if no team is selected -->
                                <div class="p-4 bg-gray rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold">{{ $task->title }}</h3>
                                    <p class="text-gray-400">{{ $task->description }}</p>
                                    <p class="text-sm text-gray-500">Due Date:
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }} at
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('g:i A') }}</p>
                                    <p class="text-sm text-gray-500">Priority: {{ $task->priority }}</p>
                                    <p class="text-sm text-gray-500">Service Fee: {{ $task->service_fee }}</p>
                                    <p class="text-sm text-gray-500">Assigned to: {{ $task->assigned_firstname }}
                                        {{ $task->assigned_lastname }}</p>
                                    <!-- Task Status and Actions -->
                                    <p class="text-sm text-gray-500">Status: {{ $task->status }}</p>
                                    @if ($task->status === 'pending')
                                        <form action="{{ route('tasks.start', $task->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded">Start Task</button>
                                        </form>
                                    @elseif($task->status === 'in-progress')
                                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-emeraldlight2 text-black px-4 py-2 rounded">Complete
                                                Task</button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
