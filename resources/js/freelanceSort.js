// resources/js/freelanceSort.js

document.addEventListener("DOMContentLoaded", () => {
    const searchForm = document.querySelector("#search-form");
    const resetButton = document.querySelector("#reset-btn");
    const freelancersContainer = document.querySelector(
        "#freelancers-container"
    );

    // Function to fetch and update the freelancers list
    async function fetchFreelancers(queryString = "") {
        try {
            const response = await fetch(
                `${searchForm.action}?${queryString}`,
                {
                    headers: {
                        Accept: "application/json",
                    },
                }
            );

            if (!response.ok) {
                // Log response status and text for debugging
                console.error(
                    `HTTP error ${response.status}: ${response.statusText}`
                );
                const errorText = await response.text();
                console.error("Error details:", errorText);
                return;
            }

            const data = await response.json();
            freelancersContainer.innerHTML = data.html;
            // Optionally update the count if needed
            // const countElement = document.querySelector('#count');
            // countElement.textContent = data.count;
        } catch (error) {
            console.error("Error:", error);
        }
    }

    if (searchForm) {
        // Handle form submission
        searchForm.addEventListener("submit", async (event) => {
            event.preventDefault();

            const formData = new FormData(searchForm);
            const queryString = new URLSearchParams(formData).toString();

            await fetchFreelancers(queryString);
        });
    }

    if (resetButton) {
        // Handle reset button click
        resetButton.addEventListener("click", () => {
            searchForm.reset(); // Clear form inputs

            // Fetch freelancers without any query parameters
            fetchFreelancers();
        });
    }

    // Initial fetch to load freelancers on page load
    fetchFreelancers();
});
