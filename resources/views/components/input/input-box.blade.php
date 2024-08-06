@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'flex p-1.5 w-full rounded-lg
border-spacing-2 border-zinc-400 border-2 bg-transparent focus:border-emerald
focus:ring-emerald shadow-sm']) !!}>