<div id="assignTaskModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-light3 hidden">
    <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Assign Task</h2>

        <form method="POST" action="{{ route('projects.save') }}" enctype="multipart/form-data">
            @csrf

            <!-- Hidden Inputs -->
            <input type="hidden" name="assigned_id" id="assignedId">
            <input type="hidden" name="assigned_fullname" id="assignedFullName">

            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Task Title:</label>
                <input id="title" name="title" type="text" class="w-full p-2 border rounded-lg" required>
                @error('title')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Task Description:</label>
                <textarea id="description" name="description" rows="4" class="w-full p-2 border rounded-lg"></textarea>
                @error('description')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Service Fee Field -->
            <div class="mb-4">
                <label for="serviceFee" class="block text-gray-700">Service Fee (₱):</label>
                <input id="service_fee" name="service_fee" type="number" step="0.01"
                    class="w-full p-2 border rounded-lg" required>
                @error('service_fee')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Due Date Field -->
            <div class="mb-4">
                <label for="dueDate" class="block text-gray-700">Due Date and Time:</label>
                <input id="dueDate" name="due_date" type="datetime-local" class="w-full p-2 border rounded-lg"
                    required>
                @error('due_date')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Priority Field -->
            <div class="mb-4">
                <label for="priority" class="block text-gray-700">Priority:</label>
                <select id="priority" name="priority" class="w-full p-2 border rounded-lg" required>
                    <option value="low">Low</option>
                    <option value="high">High</option>
                </select>
                @error('priority')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload Field -->
            <div class="mb-4">
                <label for="taskImages" class="block text-gray-700">Upload Images (up to 3):</label>
                <input id="taskImages" name="images[]" type="file" accept="image/*" multiple
                    class="w-full p-2 border rounded-lg">
                @error('images.*')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <small class="text-gray-500">You can upload up to 3 images.</small>
            </div>

            <!-- Form Buttons -->
            <div class="flex justify-end">
                <button type="button" class="bg-white text-black py-2 px-4 border rounded-lg mr-2"
                    onclick="hideAssignTaskModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Assign Task</button>
            </div>
        </form>
    </div>
</div>
