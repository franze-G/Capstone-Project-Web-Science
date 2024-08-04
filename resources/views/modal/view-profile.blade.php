<div id="profileModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full">

    <div class="relative top-60 mx-auto p-5 border w-fit shadow-lg rounded-md bg-black text-white">

        <!-- Close Button Container -->
        <div class="absolute top-2 left-2">
            <button onclick="closeProfileModal()"
                class="bg-gray-500 text-black p-2 rounded hover:bg-gray-600 flex items-center justify-center">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <h2 id="userName" class="text-2xl font-bold mb-4 capitalize text-center"></h2>
        <p class="mb-2 text-center text-sm"><span id="userEmail"></span></p>
        <p class="mb-2 text-center text-sm font-semibold"><span id="position"></span></p>

        <!-- Task Statistics -->
        <div class=" flex flex-col justify-center items-center mb-6">
            <div class="mr-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-gray-700">
                <p class="flex justify-between w-full"><span class="font-semibold">Pending Tasks:</span> <span
                        id="userPendingTasks"></span></p>
                <p class="flex justify-between w-full"><span class="font-semibold">In Progress:</span> <span
                        id="userInProgressTasks"></span></p>
                <p class="flex justify-between w-full"><span class="font-semibold">Completed:</span> <span
                        id="userCompletedTasks"></span></p>
            </div>
        </div>

        <!-- Star Rating System -->
        <div class="flex flex-col items-center mb-4">
            <p class="mb-2">Rating</p>
            <div class="flex items-center mb-4" id="starRatingContainer">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 cursor-pointer star-rating" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor" data-rating="{{ $i }}">
                        <path
                            d="M12 17.27L18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27z" />
                    </svg>
                @endfor
            </div>
            <button id="rate-button" class="px-4 py-2 bg-emeraldlight2 text-black rounded" onclick="submitRating()">
                Rate
            </button>
        </div>

    </div>
</div>
