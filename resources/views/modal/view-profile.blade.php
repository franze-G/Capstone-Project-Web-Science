<div id="profileModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">


    <div class="relative top-20 mx-auto p-5 border w-max shadow-lg rounded-md bg-white">

        <h2 id="userName" class="text-2xl *:font-sfprodisplay font-bold mb-4 capitalize text-center"></h2>
        <p class="mb-2 text-center text-sm"><span id="userEmail"></span></p>
        <p class="mb-2 text-center text-sm font-semibold"><span id="position"></span></p>

        <!-- Star Rating System -->

        <!-- Task Statistics -->
        <div class="mb-6">
            {{-- <h3 class="font-bold text-lg mb-2">Task Statistics</h3> --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-gray-700">

                <p class="flex justify-between"><span class="font-semibold">Pending Tasks:</span> <span
                        id="userPendingTasks"></span></p>

                <p class="flex justify-between"><span class="font-semibold">In Progress:</span> <span
                        id="userInProgressTasks"></span></p>

                <p class="flex justify-between"><span class="font-semibold">Completed:</span> <span
                        id="userCompletedTasks"></span></p>

                {{-- <p class="flex justify-between"><span class="font-semibold">Total Tasks:</span> <span
                        id="userTotalTasks"></span></p> --}}
            </div>
        </div>



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

        <!-- Close Button -->
        <button onclick="closeProfileModal()"
            class="w-full mt-4 bg-gray-500 text-black px-4 py-2 rounded hover:bg-gray-600">
            Close
        </button>
    </div>
</div>
