<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team Invitations') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4 text-white">
        {{-- <h2 class="text-2xl font-bold mb-4">{{ __('Team Invitations') }}</h2> --}}

        @if ($invitations->isEmpty())
            <p>{{ __('You have no team invitations.') }}</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b text-black">{{ __('Owner') }}</th>
                            <th class="px-4 py-2 border-b text-black">{{ __('Team Name') }}</th>
                            <th class="px-4 py-2 border-b  text-black">{{ __('Role') }}</th>
                            <th class="px-4 py-2 border-b  text-black">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invitations as $invitation)
                            <tr>
                                <td class="px-4 py-2 border-b text-black">
                                    {{ $invitation->team->user_firstname }} {{ $invitation->team->user_lastname }}</td>
                                <td class="px-8 py-4 border-b text-black">{{ $invitation->team->name }}</td>
                                <td class="px-4 py-2 border-b  text-black">{{ $invitation->role }}</td>
                                <td class="px-4 py-2 border-b text-black">
                                    <a href="{{ route('team-invitation.accept', $invitation->id) }}"
                                        class="text-blue-500 hover:underline">{{ __('Accept') }}</a>
                                    <form action="{{ route('team-invitation.destroy', $invitation->id) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:underline">{{ __('Decline') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
