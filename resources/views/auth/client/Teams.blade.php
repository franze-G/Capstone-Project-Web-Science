<x-app-layout>
  @section('title','Teams')
  <div class="py-10 px-0">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-black dark:bg-gray-800 text-white shadow sm:rounded-xl">
        <div class="max-w-xl">

          {{-- include taks-form which is --}}
          @include('modal.task-form')

        </div>
      </div>
    </div>

</x-app-layout>