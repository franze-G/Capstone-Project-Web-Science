<x-mail::message>
    {{ __('You have been invited to join the :team team!', ['team' => $invitation->team->name]) }}

    <x-mail::button :url="$acceptUrl">
        {{ __('Accept Invitation') }}
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
