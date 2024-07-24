<x-app-layout>

  <!-- search bar, gawing component later -->
  <div>
  </div>
  <!-- body -->
  <div class="m-10 text-white">
    <!-- card/freelance display container -->
    <h1 class="text-2xl font-bold mb-4">People</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
      @foreach ($freelancers as $freelancer)
      <x-card.card :user="$freelancer" />
      @endforeach
    </div>
  </div>

</x-app-layout>