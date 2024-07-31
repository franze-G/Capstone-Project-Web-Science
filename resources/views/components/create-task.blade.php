<div>
  <x-dashboard-titles>
    Create Task
  </x-dashboard-titles>
  <form action="" method="POST">
    @csrf
    <div class="flex flex-col p-6 bg-gray/30 rounded-xl">
      <input name="" id="" type="text" placeholder="Task Title..."
        class="bg-transparent border-none rounded-none shadow-none bg-n placeholder-slate-200 focus:ring-0">
      <!-- buttons -->
      <div>
        <x-buttons.gray-button>
        </x-buttons.gray-button>
        <x-button>Due Date</x-button>
      </div>


      <x-button class="p-2 ms-4">
        {{ __('Register') }}
      </x-button>
    </div>
  </form>

</div>