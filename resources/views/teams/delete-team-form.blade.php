<x-action-section class="text-white">
    <x-slot name="title">
        {{ __('Manage Team') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage your team’s resources and actions.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('You can choose to delete or archive this team. Deleting a team will permanently remove all of its
            data. Archiving a team will mark it as archived but retain its data.') }}
        </div>

        <div class="mt-5">
            <!-- Archive Team Button -->
            <x-secondary-button wire:click="$toggle('confirmingTeamArchiving')" wire:loading.attr="disabled">
                {{ __('Archive Team') }}
            </x-secondary-button>

            <!-- Delete Team Button -->
            <x-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                {{ __('Delete Team') }}
            </x-danger-button>
        </div>

        <!-- Archive Team Confirmation Modal -->
        <x-confirmation-modal wire:model.live="confirmingTeamArchiving">
            <x-slot name="title">
                {{ __('Archive Team') }}
            </x-slot>

            <x-slot name="content" class="bg-emerald/35">
                {{ __('Are you sure you want to archive this team? Archiving the team will mark it as archived but
                retain its data for future reference.') }}
            </x-slot>

            <x-slot name="footer" class="bg-emerald/35">
                <x-secondary-button wire:click="$toggle('confirmingTeamArchiving')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-secondary-button class="ms-3" wire:click="archiveTeam" wire:loading.attr="disabled">
                    {{ __('Archive Team') }}
                </x-secondary-button>
            </x-slot>
        </x-confirmation-modal>

        <!-- Delete Team Confirmation Modal -->
        <x-confirmation-modal wire:model.live="confirmingTeamDeletion">
            <x-slot name="title">
                {{ __('Delete Team') }}
            </x-slot>

            <x-slot name="content" class="bg-emerald/35">
                {{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data
                will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer" class="bg-emerald/35">
                <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteTeam" wire:loading.attr="disabled">
                    {{ __('Delete Team') }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
    </x-slot>
</x-action-section>