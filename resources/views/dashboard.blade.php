<x-app-layout>
    <!-- x-app-layout's header is located sa app.blade.php may sarili siyang styling -->
    <x-slot name="header">
        <div class="font-semibold text-xl text-white leading-tight">
            @if (Auth::user()->isClient())
            {{ __('Client') }}
            @elseif (Auth::user()->isFreelancer())
            {{ __('Freelance') }}
            @endif
            {{ __('Dashboard') }}
            {{-- {{ auth()->user()->currentTeam->name }} Dashboard --}}
        </div>
    </x-slot>

    <!-- body -->
    <div class="flex justify-between text-white p-6">
        <div class="">
            <label for="">Project Summary</label>
        </div>
        <div>
            <label for="">Notifications</label>
        </div>
    </div>




</x-app-layout>