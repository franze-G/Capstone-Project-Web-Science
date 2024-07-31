document.addEventListener("DOMContentLoaded", () => {
    // Make these functions global so they can be called from HTML
    window.showAssignTaskModal = function (userId, userFullName) {
        // Show the modal
        const modal = document.getElementById("assignTaskModal");
        if (modal) {
            modal.querySelector(
                "h2"
            ).innerText = `Assign Task to ${userFullName}`;

            // Store user details in hidden inputs
            modal.querySelector('input[name="assigned_id"]').value = userId;
            modal.querySelector('input[name="assigned_fullname"]').value =
                userFullName;

            modal.classList.remove("hidden");
        }
    };

    window.hideAssignTaskModal = function () {
        const modal = document.getElementById("assignTaskModal");
        if (modal) {
            modal.classList.add("hidden");
        }
    };

    // Add event listener to the form for assigning tasks
    const assignTaskForm = document.getElementById("assignTaskForm");
    if (assignTaskForm) {
        assignTaskForm.addEventListener("submit", function (event) {
            event.preventDefault();

            // Retrieve task details and user info
            const taskDescription =
                document.getElementById("taskDescription").value;
            const userId = document.querySelector(
                'input[name="assigned_id"]'
            ).value;
            const userFullName = document.querySelector(
                'input[name="assigned_fullname"]'
            ).value;

            // Perform AJAX request to assign task
            fetch("/assign-task", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    taskDescription: taskDescription,
                    userId: userId,
                    userFullName: userFullName,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Task assigned successfully.");
                        hideAssignTaskModal();
                    } else {
                        alert("Failed to assign task.");
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    }
});
