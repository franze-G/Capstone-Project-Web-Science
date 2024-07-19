<x-app-layout>
    <!-- body -->
    <div>
        @if (Auth::user()->isClient())
        <x-client.dashboard />
        @elseif (Auth::user()->isFreelancer())
        <x-freelance.dashboard />
        @endif
    </div>

</x-app-layout>