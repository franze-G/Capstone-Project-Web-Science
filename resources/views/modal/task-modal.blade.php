<div id="taskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

        <h3 id="taskModalTitle" class="font-sfpro text-2xl font-semibold mb-4 capitalize text-center"></h3>
        <p class="mb-4 font-semibold">Description: <span id="taskModalDescription" class="mb-4"></span></p>
        <p class="mb-4 font-semibold">Due Date: <span class="" id="taskModalDueDate"></span></p>
        <p class="mb-4 font-semibold">Priority: <span class="" id="taskModalPriority"></span></p>
        <p class="mb-4 font-semibold">Service Fee: <span class="" id="taskModalServiceFee"></span></p>
        <p class="mb-4 font-semibold">Assigned to: <span class="" id="taskModalAssignedTo"></span></p>
        <p class="mb-4 font-semibold">Status: <span class="capitalize" id="taskModalStatus"></span></p>

        <div id="taskActions" class="flex justify-end mt-4">
            <!-- Actions will be inserted here by JavaScript -->
        </div>
        <button onclick="document.getElementById('taskModal').classList.add('hidden');"
            class="bg-emeraldlight2 text-black px-4 py-2 rounded mt-4">Close</button>
    </div>
</div>
