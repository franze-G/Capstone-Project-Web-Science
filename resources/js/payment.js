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

    // Handle PayMongo payment completion and redirect to activity.index
    window.checkPaymentStatus = function (paymentId) {
        const options = {
            method: "GET",
            headers: {
                accept: "application/json",
                authorization:
                    "Basic c2tfdGVzdF9hVGpHOWI0Zmh4a1dGcWlSZ0g3cjhLYVI6",
            },
        };

        fetch(`https://api.paymongo.com/v1/payments/${paymentId}`, options)
            .then((response) => response.json())
            .then((data) => {
                if (
                    data.data &&
                    data.data.attributes &&
                    data.data.attributes.status === "paid"
                ) {
                    fetch(`/tasks/update-status/${paymentId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                        body: JSON.stringify({ status: "paid" }),
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                window.location.href = `/activities?task_id=${data.task_id}`; // Redirect to the activity index page with task ID
                            } else {
                                console.error(
                                    "Failed to update task status:",
                                    data
                                );
                            }
                        })
                        .catch((err) => console.error("Fetch error:", err));
                } else {
                    console.error("Payment status check failed:", data);
                }
            })
            .catch((err) => console.error("Fetch error:", err));
    };

    // Star rating functionality
    window.rateTask = function (taskId, rating) {
        // Highlight selected stars
        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById(`star-${taskId}-${i}`);
            if (star) {
                if (i <= rating) {
                    star.classList.add("text-yellow-400");
                    star.classList.remove("text-gray-300");
                } else {
                    star.classList.add("text-gray-300");
                    star.classList.remove("text-yellow-400");
                }
            }
        }

        // Send rating to server
        fetch("/tasks/rate", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                taskId: taskId,
                rating: rating,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    console.log("Rating saved successfully");
                } else {
                    console.error("Failed to save rating:", data);
                }
            })
            .catch((error) => {
                console.error("Error saving rating:", error);
            });
    };
});
