@props(['theme' => 'light'])

<button 
    {{ $attributes->class([
        'flex items-center p-2 font-medium transition duration-300 ease-in-out rounded focus:outline-none select-none',
        'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' => $theme == 'light',
    ]) }}
>
    {{ $slot }}
</button>