<x-app-layout>
    <div class="m-10 text-white">
        <x-texts.title>Team Invitations</x-texts.title>
        <section class="">
            @if ($invitations->isEmpty())
                <p>{{ __('You have no team invitations.') }}</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-emerald/35 radius-lg">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b text-white">{{ __('Team Manager') }}</th>
                                <th class="px-4 py-2 border-b text-white">{{ __('Team Name') }}</th>
                                <th class="px-4 py-2 border-b text-white">{{ __('Role') }}</th>
                                <th class="px-4 py-2 border-b text-white">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invitations as $invitation)
                                <tr>
                                    <td class="px-4 py-2 border-b text-white text-center">
                                        {{ $invitation->team->user_firstname }} {{ $invitation->team->user_lastname }}
                                    </td>
                                    <td class="px-8 py-4 border-b text-white text-center">{{ $invitation->team->name }}
                                    </td>
                                    <td class="px-4 py-2 border-b text-white text-center">{{ $invitation->role }}</td>
                                    <td class="px-4 py-2 border-b text-black text-center">
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
        </section>
    </div>
</x-app-layout>
