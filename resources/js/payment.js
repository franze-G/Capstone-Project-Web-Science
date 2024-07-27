// Ensure the code runs after the DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    // Task verification functionality
    document.querySelectorAll('form[id^="verify-form-"]').forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const taskId = this.id.replace("verify-form-", "");
            this.style.display = "none"; // Hide the verify button
            const payButton = document.getElementById(`pay-button-${taskId}`);
            if (payButton) {
                payButton.style.display = "inline"; // Show the pay button
            }

            fetch(this.action, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    _method: "POST",
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (!data.ok) {
                        console.error("Verify request failed:", data);
                    }
                })
                .catch((error) => console.error("Fetch error:", error));
        });
    });

    // Task modal functionality
    window.showAssignTaskModal = function (userId, userFullName) {
        const modal = document.getElementById("assignTaskModal");
        if (modal) {
            modal.querySelector(
                "h2"
            ).innerText = `Assign Task to ${userFullName}`;
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

    const assignTaskForm = document.getElementById("assignTaskForm");
    if (assignTaskForm) {
        assignTaskForm.addEventListener("submit", function (event) {
            event.preventDefault();
            const taskDescription =
                document.getElementById("taskDescription").value;
            const userId = document.querySelector(
                'input[name="assigned_id"]'
            ).value;
            const userFullName = document.querySelector(
                'input[name="assigned_fullname"]'
            ).value;

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

    // Payment functionality
    window.payTask = function (taskId, amount, description) {
        const options = {
            method: "POST",
            headers: {
                accept: "application/json",
                "content-type": "application/json",
                authorization:
                    "Basic c2tfdGVzdF9hVGpHOWI0Zmh4a1dGcWlSZ0g3cjhLYVI6",
            },
            body: JSON.stringify({
                data: {
                    attributes: {
                        amount: parseInt(amount * 100), // Convert to cents
                        description: description,
                        remarks: "Thank you for your payment",
                    },
                },
            }),
        };

        fetch("https://api.paymongo.com/v1/links", options)
            .then((response) => response.json())
            .then((response) => {
                console.log("PayMongo API Response:", response);
                if (
                    response.data &&
                    response.data.attributes &&
                    response.data.attributes.checkout_url
                ) {
                    window.location.href =
                        response.data.attributes.checkout_url; // Redirect to the payment link
                } else {
                    console.error("Payment link creation failed:", response);
                    alert("Failed to create payment link. Please try again.");
                }
            })
            .catch((err) => {
                console.error("Fetch error:", err);
                alert("An error occurred. Please try again.");
            });
    };
});
