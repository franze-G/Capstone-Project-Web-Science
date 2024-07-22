document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM fully loaded and parsed");

    // Show modal functionality
    function showAssignTaskModal(userFullName) {
        const modal = document.getElementById("assignTaskModal");
        modal.querySelector("h2").innerText = `Assign Task to ${userFullName}`;
        modal.classList.remove("hidden");
    }

    // Hide modal functionality
    function hideAssignTaskModal() {
        const modal = document.getElementById("assignTaskModal");
        modal.classList.add("hidden");
    }

    // Handle click event for assign task buttons
    document
        .querySelectorAll("button[data-user-fullname]")
        .forEach((button) => {
            button.addEventListener("click", () => {
                const userFullName = button.getAttribute("data-user-fullname");
                showAssignTaskModal(userFullName);
            });
        });

    // Handle close modal button click
    const closeModalButton = document.querySelector("#closeAssignTaskModal");
    if (closeModalButton) {
        closeModalButton.addEventListener("click", () => {
            hideAssignTaskModal();
        });
    }

    // Close modal when clicking outside of it
    const assignTaskModal = document.getElementById("assignTaskModal");
    window.addEventListener("click", (event) => {
        if (event.target === assignTaskModal) {
            hideAssignTaskModal();
        }
    });

    // // Handle form submission
    // const assignTaskForm = document.getElementById("assignTaskForm");
    // if (assignTaskForm) {
    //     assignTaskForm.addEventListener("submit", function (event) {
    //         event.preventDefault(); // Prevent the default form submission

    //         const formData = new FormData(this); // Gather all form data including files

    //         fetch(this.action, {
    //             method: this.method,
    //             headers: {
    //                 "X-CSRF-TOKEN": document
    //                     .querySelector('meta[name="csrf-token"]')
    //                     .getAttribute("content"),
    //             },
    //             body: formData,
    //         })
    //             .then((response) => response.json())
    //             .then((data) => {
    //                 if (data.success) {
    //                     alert("Task assigned successfully.");
    //                     hideAssignTaskModal();
    //                 } else {
    //                     alert("Failed to assign task.");
    //                 }
    //             })
    //             .catch((error) => console.error("Error:", error));
    //     });
    // }
});
