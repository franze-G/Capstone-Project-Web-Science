document.addEventListener("DOMContentLoaded", () => {
    const searchForm = document.querySelector("#search-form");
    const resetButton = document.querySelector("#reset-btn");
    const freelancersContainer = document.querySelector(
        "#freelancers-container"
    );
    const sortModal = document.querySelector("[x-data]");
    const sortForm = sortModal ? sortModal.querySelector("form") : null;

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
                console.error(
                    `HTTP error ${response.status}: ${response.statusText}`
                );
                const errorText = await response.text();
                console.error("Error details:", errorText);
                return;
            }

            const data = await response.json();
            freelancersContainer.innerHTML = data.html;
        } catch (error) {
            console.error("Error:", error);
        }
    }

    if (searchForm) {
        // Handle search form submission
        searchForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            const formData = new FormData(searchForm);
            const queryString = new URLSearchParams(formData).toString();
            await fetchFreelancers(queryString);
        });
    }

    if (resetButton) {
        // Handle reset button click
        resetButton.addEventListener("click", async (event) => {
            event.preventDefault();
            searchForm.reset(); // Clear form inputs
            await fetchFreelancers(); // Fetch freelancers without any query parameters
        });
    }

    if (sortForm) {
        // Handle sort form submission
        sortForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            const formData = new FormData(sortForm);
            const queryString = new URLSearchParams(formData).toString();
            await fetchFreelancers(queryString);

            // Close the modal
            if (typeof sortModal.__x !== "undefined") {
                sortModal.__x.$data.open = false;
            }
        });
    }

    // Only fetch freelancers on page load if there are no existing query parameters
    if (!window.location.search) {
        fetchFreelancers();
    }
});
