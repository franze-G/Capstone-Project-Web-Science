document.addEventListener("DOMContentLoaded", function () {
    function showTaskModal(task) {
        // Populate the modal with task details
        document.getElementById("taskModalTitle").innerText = task.title;
        document.getElementById("taskModalDescription").innerText =
            task.description;
        document.getElementById("taskModalDueDate").innerText = task.due_date;
        document.getElementById("taskModalPriority").innerText = task.priority;
        document.getElementById("taskModalServiceFee").innerText =
            task.service_fee;
        document.getElementById("taskModalAssignedTo").innerText =
            task.assigned_to;
        document.getElementById("taskModalStatus").innerText = task.status;

        // Clear previous action buttons
        const actionsDiv = document.getElementById("taskActions");
        actionsDiv.innerHTML = "";

        // Get CSRF token from meta tag
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        // Add appropriate action buttons based on task status
        if (task.status === "pending" || task.status === "in-progress") {
            actionsDiv.innerHTML += `
                <form action="/freelance/tasks/${task.id}/start" method="POST" class="inline ms-2">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Start Task</button>
                </form>
            `;
        }
        if (task.status === "in-progress") {
            actionsDiv.innerHTML += `
                <form action="/freelance/tasks/${task.id}/complete" method="POST" class="inline ms-2">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <button type="submit" class="bg-emerald text-black px-4 py-2 rounded">Complete Task</button>
                </form>
            `;
        }
        if (task.status === "completed") {
            actionsDiv.innerHTML += `
                <p class="bg-yellow-300 text-black px-4 py-2 rounded">Waiting for Payment and Verification</p>
            `;
        }

        // Show the modal
        document.getElementById("taskModal").classList.remove("hidden");
    }

    function sortTasks() {
        const sortFilter = document.getElementById("sortFilter").value;
        const container = document.getElementById("taskContainer");
        const tasks = Array.from(container.querySelectorAll(".task-card"));

        tasks.sort((a, b) => {
            const priorityOrder = {
                low: 1,
                medium: 2,
                high: 3,
            };
            const dueDateA = new Date(a.getAttribute("data-due-date"));
            const dueDateB = new Date(b.getAttribute("data-due-date"));

            switch (sortFilter) {
                case "priority-asc":
                    return (
                        priorityOrder[a.getAttribute("data-priority")] -
                        priorityOrder[b.getAttribute("data-priority")]
                    );
                case "priority-desc":
                    return (
                        priorityOrder[b.getAttribute("data-priority")] -
                        priorityOrder[a.getAttribute("data-priority")]
                    );
                case "due-date-asc":
                    return dueDateA - dueDateB;
                case "due-date-desc":
                    return dueDateB - dueDateA;
                default:
                    return 0;
            }
        });

        // Append sorted tasks to the container
        tasks.forEach((task) => container.appendChild(task));
    }

    document.getElementById("sortFilter").addEventListener("change", sortTasks);

    // Make the function globally accessible
    window.showTaskModal = showTaskModal;
});
