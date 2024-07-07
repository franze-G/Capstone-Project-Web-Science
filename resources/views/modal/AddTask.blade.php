<section>
    <div id="addTaskModal" class="fixed inset-0 items-center justify-center z-50 flex">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/2 text-black">
            <h2 class="text-xl mb-4">Add Task</h2>
            <form action="{{ route('addtask.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="Title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="Title" name="title" class="mt-1 block w-full" >
                </div>
                <div class="mb-4">
                    <label for="Description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="Description" name="description" class="mt-1 block w-full" ></textarea>
                </div>
                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date and Time</label>
                    <input type="datetime-local" id="due_date" name="due_date" class="mt-1 block w-full" >
                </div>
                <div class="mb-4">
                    <label for="rate" class="block text-sm font-medium text-gray-700">Rate</label>
                    <input type="number" id="rate" name="rate" class="mt-1 block w-full" >
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" id="image" name="image" multiple class="mt-1 block w-full" >
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModalButton" class="mr-4 px-4 py-2 bg-gray-300 rounded-lg">Cancel</button>
                    <button type="submit" id="addTaskModal" class="px-4 py1-2 bg-black text-white rounded-lg">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</section>
