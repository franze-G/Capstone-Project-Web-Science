<div id="taskModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-black text-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h3 id="taskModalTitle" class="text-xl font-semibold mb-4 capitalize"></h3>
        <p class="mb-4">Description: <span id="taskModalDescription" class="mb-4"></span></p>
        <p class="mb-4">Due Date: <span id="taskModalDueDate"></span></p>
        <p class="mb-4">Priority: <span id="taskModalPriority"></span></p>
        <p class="mb-4">Service Fee: <span id="taskModalServiceFee"></span></p>
        <p class="mb-4">Assigned to: <span id="taskModalAssignedTo"></span></p>
        <p class="mb-4">Status: <span id="taskModalStatus"></span></p>

        <div class="flex justify-between">
            <div id="taskActions" class="mt-4">
                <!-- Actions will be inserted here by JavaScript -->
            </div>
            <button onclick="document.getElementById('taskModal').classList.add('hidden');"
                class="bg-emeraldlight2 text-black px-4 py-2 rounded mt-4">Close</button>
        </div>

    </div>
</div>
