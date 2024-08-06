<div class="flex flex-col justify-between p-4 rounded-lg shadow-lg text-slate-800 bg-zinc-100">
    <!-- img -->
    <img class="w-full h-32 object-cover rounded-lg" src="{{ $user->profile_photo_url }}" alt="Person">
    <!-- details -->
    <h3 class="text-lg font-semibold mt-2">{{ $user->firstname }} {{ $user->lastname }}</h3>
    <!-- position -->
    <p class="text-slate-600 "> {{ $user->position }}</p>
    <!-- completed tasks -->
    <p class="mt-2 ">Completed Tasks<span class="font-semibold"> {{-- {{$user->tasks->count()}} --}}</span></p>
    <!-- star rating -->
    <p>Rating <span class="font-semibold">
            @for ($i = 1; $i <= 5; $i++)
                <span class="text-yellow">{{ $i <= $user->star_rating ? '★' : '☆' }}</span>
            @endfor
        </span></p>
    <button class="bg-emerald text-white/90 mt-2 w-full py-2 rounded-md">Send Invitation</button>
    <!-- rating -->
    <div>
        <!-- Additional content can go here if needed -->
    </div>
</div>
