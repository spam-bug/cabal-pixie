<x-portal-layout page-name="Ability">
    <div class="grid grid-cols-4 gap-8">
        
        <x-card class="space-y-4">
            <x-card.title>Download Files</x-card.title>

            <x-button class="w-full">Ability.dec</x-button>
            <x-button class="w-full">Ability.scp</x-button>
        </x-card>
    </div>

    <livewire:ability-table />
</x-portal-layout>