<section class="space-y-6">

    <header class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Add Task
    </header>

    <x-danger-button x-data='' x-on:click.prevent="$dispatch('open-modal', 'task-form')">{{ __('Add new task') }}
    </x-danger-button>

    <x-modal name='task-form' class="bg-black" focusable> 

        <form method="post" action="" class="p-6">
            @csrf
    
            <h2 class="text-black">Meow</h2>

            <h2 class="text-lg font-medium text-black dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }} 
            </h2>

            {{-- input boxes --}}

                <div class="">

                    <x-input-label class="mt-4" for="title" :value="__('Title')" />

                        <x-text-input id="title" class="block mt-2 w-full" type="text" name="title"
                        :value="old('firstname')" required autofocus autocomplete="title" />

                    <x-input-label class="mt-2" for="description" :value="__('Description')" />

                        <textarea id="description" name="description" class="block mt-2 w-full text-black rounded-md" required autofocus>{{ old('description') }}</textarea>

                    <x-input-label class="mt-2" for="fee" :value="__('Service Fee')" />

                        <x-text-input id="fee" class="block mt-2 w-full" type="number" name="fee"
                        :value="old('fee')" required autofocus autocomplete="title" />

                   <!-- Grid Container for Inputs -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <!-- Service Fee Dropdown -->
                        <div>
                            <x-input-label class="mt-2" for="fee" :value="__('Priority')" />
                            <select id="fee" name="fee" class="block mt-2 w-full text-black rounded-md" required autofocus>
                                <option value="low" {{ old('fee') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="high" {{ old('fee') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <!-- Due Date Input -->
                        <div>
                            <x-input-label class="mt-2" for="due_date" :value="__('Due Date')" />
                            <input id="due_date" name="due_date" type="datetime-local" class="block mt-2 w-full rounded-md border-black text-black shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('due_date') }}" required autofocus>
                        </div>
                    </div>

                    <x-input-label class="mt-4" for="image" :value="__('Image')" />

                    <x-text-input id="title" class="block mt-2 w-full" type="file" name="image"
                    :value="old('firstname')" required autofocus autocomplete="title" />


                </div>

            {{-- pang submit --}}

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