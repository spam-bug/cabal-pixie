@props(["submit" => ""])

<x-card>
    <form wire:submit="{{ $submit }}">
        <div class="space-y-1">
            {{ $header }}
        </div>


        <div class="mt-4">
            {{ $content }}
        </div>

        <div class="mt-4">
            {{ $footer }}
        </div>
    </form>
</x-card>