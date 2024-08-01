<div id="profileModal" class="hidden fixed inset-0 bg-gray bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h2 id="userName" class="text-xl font-bold mb-4"></h2>
        <p class="mb-2">Email: <span id="userEmail"></span></p>

        <!-- Star Rating System -->
        <div class="mb-4">
            <p class="mb-2">Star Rating:</p>
            <div class="flex items-center" id="starRatingContainer">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 cursor-pointer star-rating" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor" data-rating="{{ $i }}">
                        <path
                            d="M12 17.27L18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27z" />
                    </svg>
                @endfor
            </div>
        </div>

        <!-- Rate Button -->
        <button id="rate-button" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded" onclick="submitRating()">
            Rate
        </button>

        <!-- Task Statistics -->
        <h3 class="font-bold mb-2">Task Statistics</h3>
        <p>Pending Tasks: <span id="userPendingTasks"></span></p>
        <p>In Progress Tasks: <span id="userInProgressTasks"></span></p>
        <p>Completed Tasks: <span id="userCompletedTasks"></span></p>
        <p class="mb-4">Total Tasks: <span id="userTotalTasks"></span></p>

        <!-- Close Button -->
        <button onclick="closeProfileModal()"
            class="w-full mt-4 bg-gray-500 text-black px-4 py-2 rounded hover:bg-gray">
            Close
        </button>
    </div>
</div>
