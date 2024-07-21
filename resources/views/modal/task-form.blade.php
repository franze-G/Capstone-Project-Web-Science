<!-- resources/views/modal/task-form.blade.php -->
<div id="assignTaskModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-light flex hidden">
    <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Assign Task</h2>

        <form id="assignTaskForm" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="taskTitle" class="block text-gray-700">Task Title:</label>
                <input id="taskTitle" type="text" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="taskDescription" class="block text-gray-700">Task Description:</label>
                <textarea id="taskDescription" rows="4" class="w-full p-2 border rounded-lg" required></textarea>
            </div>

            <div class="mb-4">
                <label for="serviceFee" class="block text-gray-700">Service Fee ($):</label>
                <input id="serviceFee" type="number" step="0.01" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="dueDate" class="block text-gray-700">Due Date and Time:</label>
                <input id="dueDate" type="datetime-local" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="priority" class="block text-gray-700">Priority:</label>
                <select id="priority" class="w-full p-2 border rounded-lg" required>
                    <option value="low">Low</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="taskImages" class="block text-gray-700">Upload Images (up to 3):</label>
                <input id="taskImages" type="file" name="taskImages[]" accept="image/*" multiple
                    class="w-full p-2 border rounded-lg">
                <small class="text-gray-500">You can upload up to 3 images.</small>
            </div>

            <div class="flex justify-end">
                <button type="button" class="bg-white text-black py-2 px-4 border rounded-lg mr-2"
                    onclick="hideAssignTaskModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Assign Task</button>
            </div>
        </form>

    </div>
</div>
