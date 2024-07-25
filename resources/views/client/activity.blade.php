<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Completed Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-xl">

                <!-- Display Completed Tasks -->
                <div class="p-5 bg-black">
                    <h2 class="text-2xl font-semibold mb-4">Completed Tasks</h2>

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
                                        <p class="text-sm text-gray-300 mt-2">Service Fee: ${{ $task->service_fee }}</p>
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

                                        {{-- task.pay iintegrate paymongo. --}}
                                        {{-- <form action="{{ route('tasks.pay', $task->id) }}" method="POST"
                                            id="pay-form-{{ $task->id }}" style="display: none;">
                                            @csrf
                                            @method('POST')
                                           
                                        </form> --}}
                                        <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600">
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
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('form[id^="verify-form-"]').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const taskId = this.id.replace('verify-form-', '');
                // Simulate verifying the task
                this.style.display = 'none'; // Hide the verify button
                document.getElementById(`pay-form-${taskId}`).style.display =
                    'inline'; // Show the pay button
                // You can also perform an AJAX request here if needed
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        _method: 'POST'
                    })
                }).then(response => {
                    if (!response.ok) {
                        // Handle error
                    }
                });
            });
        });
    });
</script>
