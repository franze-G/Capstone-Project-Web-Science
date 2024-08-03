<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>People</x-texts.title>
        <div class="flex flex-col md:flex-row items-center justify-between mb-5 border-b-2 border-slate-300/30">
            <div class="flex items-center space-x-2 pb-4 md:mb-0 md:mr-4">
                <span class="text-white/50">{{ $freelancerCount }} Freelancers</span>
            </div>
            <div class="flex items-center space-x-2 pb-4">
                <x-modals.sort-modal />
                <div class="relative">
                    <form method="GET" action="{{ route('client.freelance-display') }}" class="flex">
                        <input type="text" name="search" placeholder="Search Job Titles" value="{{ request('search') }}"
                            class="p-2 bg-gray/30 rounded-lg focus:outline-none focus:ring-olivegreen">
                        <button type="submit" class="p-2 bg-olivegreen rounded-lg hover:bg-olivegreen">Search</button>
                        <button type="button" id="reset-btn"
                            class="p-2 bg-red-600 rounded-lg hover:bg-red-700">Reset</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="freelancers-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @include('client.freelancers-partial', ['freelancers' => $freelancers])
        </div>
    </div>

    <script src="{{ asset('js/freelanceSort.js') }}"></script>
</x-app-layout>