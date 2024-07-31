<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-emerald
  border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-emeraldlight1
  focus:bg-emeraldlight1 active:bg-emeraldlight1 focus:outline-none focus:ring-2 focus:ring-emerald
  focus:ring-offset-2
  disabled:opacity-50 transition ease-in-out duration-150']) }}>
  {{ $slot }}
</button>