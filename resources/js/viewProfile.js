let currentUserId = null; // To keep track of the current user being viewed
let currentRating = 0; // To keep track of the current rating selection

// Function to show the profile modal with user data and star rating
export function showProfileModal(user) {
    const modal = document.getElementById("profileModal");

    // Populate the modal with user data
    modal.querySelector(
        "#userName"
    ).textContent = `${user.firstname} ${user.lastname}`;
    modal.querySelector("#userEmail").textContent = user.email;
    modal.querySelector("#position").textContent = user.position;
    modal.querySelector("#userPendingTasks").textContent = user.pending_tasks;
    modal.querySelector("#userInProgressTasks").textContent =
        user.in_progress_tasks;
    modal.querySelector("#userCompletedTasks").textContent =
        user.completed_tasks;
    // modal.querySelector("#userTotalTasks").textContent = user.total_tasks;

    // Set up star rating
    fetchAndDisplayRating(user.id);
    currentUserId = user.id; // Set current user ID
    currentRating = 0; // Reset current rating

    // Show the modal
    modal.classList.remove("hidden");

    // Set up event listeners for star rating
    const stars = modal.querySelectorAll(".star-rating");
    stars.forEach((star) => {
        star.setAttribute("data-user-id", user.id);
        star.addEventListener("click", () => {
            const rating = parseInt(star.getAttribute("data-rating"));
            rateUser(user.id, rating);
        });
    });
}

// Function to fetch and display the initial rating
function fetchAndDisplayRating(userId) {
    fetch(`/user-rating/${userId}`)
        .then((response) => response.json())
        .then((data) => {
            // Update stars with the fetched rating or set to 0 if no rating is available
            updateStars(userId, data.rating || 0);
            currentRating = data.rating || 0; // Update currentRating with fetched rating or default to 0
        })
        .catch((error) => {
            console.error("Error fetching rating:", error);
            // Reset stars and rating on error
            updateStars(userId, 0);
            currentRating = 0;
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
    currentRating = rating; // Update currentRating when user clicks a star
}

// Function to submit the rating
export function submitRating() {
    if (currentRating === 0) {
        alert("Please select a rating before submitting.");
        return;
    }

    fetch(`/rate-user/${currentUserId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ rating: currentRating }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Rating submitted successfully");
                updateStars(currentUserId, currentRating); // Update stars to reflect the submitted rating
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

// Function to close the profile modal
export function closeProfileModal() {
    document.getElementById("profileModal").classList.add("hidden");
    currentRating = 0; // Reset current rating when closing the modal
}

// Setup function to initialize event listeners
function setupStarRating() {
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
