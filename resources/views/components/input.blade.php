@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-emerald
focus:ring-emerald rounded-xl shadow-sm']) !!}>