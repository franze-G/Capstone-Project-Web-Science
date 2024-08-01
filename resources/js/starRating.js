// Function to fetch and display the initial rating
function fetchAndDisplayRating(userId) {
    fetch(`/user-rating/${userId}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.rating !== undefined) {
                updateStars(userId, data.rating);
            }
        })
        .catch((error) => {
            console.error("Error fetching rating:", error);
        });
}

// Function to update the visual state of stars
function updateStars(userId, rating) {
    const stars = document.querySelectorAll(`svg[data-user-id='${userId}']`);
    stars.forEach((star) => {
        const starRating = parseInt(star.getAttribute("data-rating"));
        if (starRating <= rating) {
            star.classList.remove("text-gray");
            star.classList.add("text-yellow");
        } else {
            star.classList.remove("text-yellow");
            star.classList.add("text-gray");
        }
    });
}

// Function to handle user rating
function rateUser(userId, rating) {
    updateStars(userId, rating);
}

// Function to submit the rating
function submitRating(userId) {
    const stars = document.querySelectorAll(`svg[data-user-id='${userId}']`);
    const rating = Array.from(stars).filter((star) =>
        star.classList.contains("text-yellow")
    ).length;

    if (rating === 0) {
        alert("Please select a rating before submitting.");
        return;
    }

    fetch(`/rate-user/${userId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            rating: rating,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Rating submitted successfully");
                updateStars(userId, rating); // Update stars to reflect the submitted rating
            } else {
                alert(
                    "Error submitting rating: " +
                        (data.message || "Unknown error")
                );
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred while submitting the rating");
        });
}

// Setup function to initialize event listeners
function setupStarRating() {
    const users = document.querySelectorAll("[data-user-id]");
    users.forEach((user) => {
        const id = user.getAttribute("data-user-id");
        fetchAndDisplayRating(id);
    });

    // Add click event listeners to stars
    const stars = document.querySelectorAll("svg[data-user-id][data-rating]");
    stars.forEach((star) => {
        star.addEventListener("click", () => {
            const userId = star.getAttribute("data-user-id");
            const rating = parseInt(star.getAttribute("data-rating"));
            rateUser(userId, rating);
        });
    });
}

// Run setup when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", setupStarRating);

// Export functions that need to be accessed from outside this module
export { submitRating };
