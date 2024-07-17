document.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM fully loaded and parsed");
    const addTaskButton = document.getElementById("addTask");
    const addTaskModal = document.getElementById("addTaskModal");
    const closeModalButton = document.getElementById("closeModalButton");

    if (addTaskButton) {
        console.log("Add Task button found");
        addTaskButton.addEventListener("click", () => {
            console.log("Add Task button clicked");
            addTaskModal.classList.remove("hidden");
        });
    } else {
        console.log("Add Task button not found");
    }

    if (closeModalButton) {
        closeModalButton.addEventListener("click", () => {
            console.log("Close Modal button clicked");
            addTaskModal.classList.add("hidden");
        });
    } else {
        console.log("Close Modal button not found");
    }

    window.addEventListener("click", (event) => {
        if (event.target === addTaskModal) {
            console.log("Clicked outside the modal");
            addTaskModal.classList.add("hidden");
        }
    });
});
