@props(["theme" => "", "alignment" => "left"])

@php
    $class = "flex justify-center p-2 font-medium transition duration-300 ease-in-out rounded select-none focus:outline-none";

    switch ($alignment) {
        case "center":
            $class .= " mx-auto";
            break;

        case "right":
            $class .= " ml-auto";
            break;
        
        default:
            $class .= " mr-auto";
            break;
    }

    switch ($theme) {
        case "primary":
            $class .= " text-white bg-orange-500 hover:bg-orange-400 focus:bg-orange-400";
            break;

        case "light":
            $class .= " text-gray-700 hover:bg-gray-100 focus:bg-gray-100";
            break;
        default:
            $class .= " text-gray-700 border border-gray-200 hover:bg-gray-100 focus:bg-gray-100 hover:text-orange-500 focus:text-orange-500";
            break;
    }
@endphp

<button 
    {{ $attributes->class([$class]) }}
>
    {{ $slot }}
</button>