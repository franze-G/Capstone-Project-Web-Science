// resources/js/freelancers.js

document.addEventListener("DOMContentLoaded", () => {
    const searchForm = document.querySelector("#search-form");
    const resetButton = document.querySelector("#reset-btn");
    const freelancersContainer = document.querySelector(
        "#freelancers-container"
    );

    if (searchForm) {
        searchForm.addEventListener("submit", async (event) => {
            event.preventDefault();

            const formData = new FormData(searchForm);
            const queryString = new URLSearchParams(formData).toString();

            try {
                const response = await fetch(`/freelancers?${queryString}`);
                if (response.ok) {
                    const data = await response.json();
                    freelancersContainer.innerHTML = data.html;
                    // Update the count if needed
                    // const countElement = document.querySelector('#count');
                    // countElement.textContent = data.count;
                } else {
                    console.error("Failed to fetch data");
                }
            } catch (error) {
                console.error("Error:", error);
            }
        });

        document.querySelector("#reset-btn").addEventListener("click", () => {
            searchForm.reset();
            fetchFreelancers(); // Refresh freelancers list without search
        });

        if (resetButton) {
            resetButton.addEventListener("click", function () {
                // Clear the search input
                searchForm.querySelector('input[name="search"]').value = "";

                // Make AJAX request to reset the list
                fetch(searchForm.action, {
                    method: "GET",
                    headers: {
                        Accept: "application/json",
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        freelancersContainer.innerHTML = data.html;
                    })
                    .catch((error) => console.error("Error:", error));
            });
        }
    }

    async function fetchFreelancers() {
        try {
            const response = await fetch(`/freelancers`);
            if (response.ok) {
                const data = await response.json();
                freelancersContainer.innerHTML = data.html;
                // Update the count if needed
                // const countElement = document.querySelector('#count');
                // countElement.textContent = data.count;
            } else {
                console.error("Failed to fetch data");
            }
        } catch (error) {
            console.error("Error:", error);
        }
    }
});
