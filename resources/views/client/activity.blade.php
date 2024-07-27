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

                                        <button
                                            onclick="payTask('{{ $task->id }}', {{ $task->service_fee }}, '{{ $task->title }}')"
                                            class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 ml-2"
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('form[id^="verify-form-"]').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const taskId = this.id.replace('verify-form-', '');
                    this.style.display = 'none'; // Hide the verify button
                    document.getElementById(`pay-button-${taskId}`).style.display =
                    'inline'; // Show the pay button

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
                        }).then(response => response.json())
                        .then(data => {
                            if (!data.ok) {
                                console.error('Verify request failed:', data);
                            }
                        })
                        .catch(error => console.error('Fetch error:', error));
                });
            });
        });

        function payTask(taskId, amount, description) {
            const options = {
                method: 'POST',
                headers: {
                    'accept': 'application/json',
                    'content-type': 'application/json',
                    'authorization': 'Basic c2tfdGVzdF9hVGpHOWI0Zmh4a1dGcWlSZ0g3cjhLYVI6'
                },
                body: JSON.stringify({
                    data: {
                        attributes: {
                            amount: parseInt(amount * 100), // Convert to cents
                            description: description,
                            remarks: 'Thank you for your payment'
                        }
                    }
                })
            };

            fetch('https://api.paymongo.com/v1/links', options)
                .then(response => response.json())
                .then(response => {
                    console.log('PayMongo API Response:', response);
                    if (response.data && response.data.attributes && response.data.attributes.checkout_url) {
                        window.location.href = response.data.attributes.checkout_url; // Redirect to the payment link
                    } else {
                        console.error('Payment link creation failed:', response);
                        alert('Failed to create payment link. Please try again.');
                    }
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    alert('An error occurred. Please try again.');
                });
        }
    </script>
</x-app-layout>
