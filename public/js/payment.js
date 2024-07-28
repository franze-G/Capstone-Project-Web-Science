document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('form[id^="verify-form-"]').forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const taskId = this.id.replace("verify-form-", "");
            this.style.display = "none"; // Hide the verify button
            document.getElementById(`pay-button-${taskId}`).style.display =
                "inline"; // Show the pay button

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
});

function payTask(taskId, amount, description) {
    const options = {
        method: "POST",
        headers: {
            accept: "application/json",
            "content-type": "application/json",
            authorization: "Basic c2tfdGVzdF9hVGpHOWI0Zmh4a1dGcWlSZ0g3cjhLYVI6",
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
                window.location.href = response.data.attributes.checkout_url; // Redirect to the payment link
            } else {
                console.error("Payment link creation failed:", response);
                alert("Failed to create payment link. Please try again.");
            }
        })
        .catch((err) => {
            console.error("Fetch error:", err);
            alert("An error occurred. Please try again.");
        });
}
