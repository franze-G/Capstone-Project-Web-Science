<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>People</x-texts.title>
        <div class="flex flex-col md:flex-row items-center justify-between mb-5 border-b-2 border-slate-300/30">
            <div class="flex items-center space-x-2 pb-4 md:mb-0 md:mr-4">
                <span class="text-white/50 freelancer-count">{{ $freelancerCount }} Freelancers</span>
            </div>
            <div class="flex items-center space-x-2 pb-4">
                <x-modals.sort-modal />

                <div class="relative flex items-center">
                    <form method="GET" action="{{ route('client.freelance-display') }}" id="search-form"
                        class="flex space-x-4">
                        <input type="text" name="search" placeholder="Search Job Titles"
                            value="{{ request('search') }}"
                            class="p-2 bg-gray/30 rounded-lg focus:outline-none focus:ring-olivegreen">

                        <button type="submit"
                            class="px-4 py-2 bg-olivegreen text-white rounded-lg hover:bg-olivegreen-dark focus:outline-none focus:ring-2 focus:ring-olivegreen focus:ring-opacity-50">
                            Search
                        </button>

                        <button type="button" id="reset-btn"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">
                            Reset
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <div id="freelancers-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @include('client.freelancers-partial', ['freelancers' => $freelancers])
        </div>
    </div>
</x-app-layout>
