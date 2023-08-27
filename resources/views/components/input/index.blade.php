@props(['isDisabled' => false])

<input 
    {{ $attributes->class(['block w-full px-4 py-2 rounded bg-gray-100 border-none focus:outline-none disabled:bg-transparent']) }}
    {{ $isDisabled ? 'disabled' : '' }}
>