<section class="space-y-6">
    <header class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Add Task
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'task-form')">
        {{ __('Add new task') }}
    </x-danger-button>

    <x-modal name="task-form" class="bg-black" focusable>

        <form action="{{ route('addtask.post') }}" method="POST" class="p-6" enctype="multipart/form-data">
            @csrf
            <h2 class="text-black">Meow</h2>

            <h2 class="text-lg font-medium text-black dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <!-- Input fields -->
            <div class="">
                <x-input-label class="mt-4" for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-2 w-full" type="text" name="title" value="{{ old('title') }}" required />

                <x-input-label class="mt-2" for="description" :value="__('Description')" />
                <textarea id="description" name="description" class="block mt-2 w-full text-black rounded-md">{{ old('description') }}</textarea>

                <x-input-label class="mt-2" for="rate" :value="__('Service Fee')" />
                <x-text-input id="rate" class="block mt-2 w-full" type="number" name="rate" value="{{ old('rate') }}" required />

                <x-input-label class="mt-2" for="priority" :value="__('Priority')" />
                <select id="priority" name="priority" class="block mt-2 w-full text-black rounded-md">
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>

                <x-input-label class="mt-2" for="due_date" :value="__('Due Date')" />
                <input id="due_date" name="due_date" type="datetime-local" class="block mt-2 w-full rounded-md border-black text-black shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('due_date') }}" required>

                <x-input-label class="mt-4" for="image" :value="__('Image')" />
                <input id="image" class="block mt-2 w-full text-black" type="file" name="image[]" multiple>
            </div>

            <!-- Submit buttons -->
            <div class="mt-8 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-submit-button class="ms-3">
                    {{ __('Create Task') }}
                </x-submit-button>
            </div>
        </form>
    </x-modal>
</section>
