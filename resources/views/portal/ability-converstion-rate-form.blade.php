<x-card>
    <x-card.title>Conversion Rate</x-card.title>

    <form class="mt-4 h-[65px]" wire:submit="store">
        <div class="flex items-center gap-2" x-data>
            <x-input.label for="rate" class="whitespace-nowrap">AXP to AP</x-input.label>

            <x-input 
                type="text" 
                wire:model="rate" 
                id="rate" 
                :is-disabled="!$editable"
            />
            
            <div class="flex gap-2">
                @if($editable)
                    <x-button
                        wire:click.prevent="edit"
                    >
                        Cancel
                    </x-button>

                    <x-button
                        theme="primary"
                        wire:click.prevent="edit"
                    >
                        Save
                    </x-button>
                @else    
                    <x-button
                        wire:click.prevent="edit"
                    >
                        Change
                    </x-button>
                @endif
            </div>
        </div>
        <x-input.error for="rate" />
    </form>

</x-card>