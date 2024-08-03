<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>People</x-texts.title>
        <div class="flex flex-col md:flex-row items-center justify-between mb-5 border-b-2 border-slate-300/30">
            <div class="flex items-center space-x-2 pb-4 md:mb-0 md:mr-4">
                <span class="text-white/50">{{ $freelancerCount }} Freelancers</span>
            </div>
            <div class="flex items-center space-x-2 pb-4">
                <button class="p-2 rounded-lg hover:bg-olivegreen">Sort</button>
                <div class="relative">
                    <input type="text" placeholder="Search Job Titles"
                        class="p-2 bg-gray/30 rounded-lg focus:outline-none focus:ring-olivegreen">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($freelancers as $freelancer)
                <x-card.card :user="$freelancer" :sstar-rating="$freelancer->star_rating" />
            @endforeach
        </div>
    </div>
</x-app-layout>
