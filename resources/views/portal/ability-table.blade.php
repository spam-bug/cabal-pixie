<div class="mt-8 overflow-hidden bg-white rounded shadow">
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <div class="flex gap-4">
            <button wire:click="$set('currentTab', 'essence')" class="font-medium text-gray-700 hover:text-orange-500 focus:text-orange-500 focus:outline-none">
                Essence Runes
            </button>

            <button wire:click="$set('currentTab', 'blended')" class="font-medium text-gray-400 hover:text-orange-500 focus:text-orange-500 focus:outline-none">
                Blended Runes
            </button>
        </div>

        <div class="flex gap-2">
            <x-button>Update Database</x-button>
        </div>
    </div>

    <div class="grid grid-cols-2 p-4 border-b border-gray-200">
        <div class="flex gap-2">
            <div class="w-full">
                <x-input type="text" placeholder="Search keywords" wire:model.live="search" />
            </div>

            <x-button theme="primary">
                <x-icons.search />
            </x-button>
        </div>
    </div>

    @if($currentTab == 'essence')
        <div class="min-w-full overflow-x-auto">
            <div class="grid grid-cols-[50px_50px_repeat(5,_1fr)] bg-gray-50">
                <div class="px-4 py-2">
                    <x-input.checkbox />
                </div>
                <div class="px-4 py-2"></div>
                <div class="col-span-2 px-4 py-2">
                    <h6 class="font-semibold text-gray-500 uppercase">RUNE</h6>
                </div>
                <div class="px-4 py-2">
                    <h6 class="font-semibold text-gray-500 uppercase">MAX LEVEL</h6>
                </div>
                <div class="px-4 py-2">
                    <h6 class="font-semibold text-gray-500 uppercase">TOTAL REQUIRED AP</h6>
                </div>
                <div class="px-4 py-2">
                    <h6 class="font-semibold text-gray-500 uppercase">ACTION</h6>
                </div>
            </div>

            @foreach ($abilities as $ability)
                <div x-data="{ expanded: false }" x-on:click.outside="expanded = false">
                    <div class="grid grid-cols-[50px_50px_repeat(5,_1fr)] border-b border-gray-200 hover:bg-gray-100 cursor-pointer">
                        <div class="flex items-center p-4 ">
                            <x-input.checkbox />
                        </div>
                        <div class="flex items-center p-4 ">
                            <x-button x-on:click="expanded = ! expanded">
                                <x-icons.expand-more class="transition-transform duration-300 ease-in-out" x-bind:class="expanded ? 'rotate-180' : ''" />
                            </x-button>
                        </div>
                        <div class="flex items-center col-span-2 gap-2 p-4">
                            <div class="w-10 h-10 overflow-hidden border-2 border-gray-700">
                                <img src="{{ Vite::asset('resources/images/assault_mastery_icon.png') }}" alt="" class="object-none object-left-top w-16 h-16">
                            </div>
                            <p class="font-medium text-gray-700">{{ $ability->item->name }}</p>
                        </div>
                        <div class="flex items-center p-4 ">
                            <p class="text-gray-500">{{ $ability->max_level }}</p>
                        </div>
                        <div class="flex items-center p-4 ">
                            <p class="text-gray-500">{{ $ability->total_ap_required }}</p>
                        </div>
                        <div class="flex items-center p-4 ">
                            <a href="#" class="font-medium text-orange-500">Edit</a>
                        </div>
                    </div>

                    <div x-show="expanded" x-collapse x-cloak>
                        <div class="grid grid-cols-[50px_50px_repeat(5,_1fr)] bg-gray-50">
                            <div class="px-4 py-2"></div>
                            <div class="px-4 py-2"></div>
                            <div class="col-span-2 px-4 py-2">
                                <h6 class="font-semibold text-gray-500 uppercase">Levels</h6>
                            </div>
                            <div class="px-4 py-2">
                                <h6 class="font-semibold text-gray-500 uppercase">Added Stats</h6>
                            </div>
                            <div class="px-4 py-2">
                                <h6 class="font-semibold text-gray-500 uppercase">Required Item 1</h6>
                            </div>
                            <div class="px-4 py-2">
                                <h6 class="font-semibold text-gray-500 uppercase">Required Item 2</h6>
                            </div>
                        </div>

                        @foreach ($ability->values as $value)
                            <div class="grid grid-cols-[50px_50px_repeat(5,_1fr)] border-b border-gray-200">
                                <div class="p-4"></div>
                                <div class="p-4"></div>
                                <div class="col-span-2 p-4">
                                    <p>Level {{ $value->level }}</p>
                                </div>
                                <div class="p-4">
                                    <p>{{ $value->force_value }}</p>
                                </div>
                                <div class="p-4">
                                    @if(is_null($value->item1))
                                        <p>Not Set</p>
                                    @else
                                        <p>{{ $value->item1_count }} {{ $value->item1->name }}</p>
                                    @endif
                                </div>
                                <div class="p-4">
                                    @if(is_null($value->item2))
                                        <p>Not Set</p>
                                    @else
                                        <p>{{ $value->item2_count }} {{ $value->item2->name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @elseif($currentTab == 'blended')
        @foreach ($abilities as $ability)
            <p>{{ $ability->item->name }}</p>
        @endforeach
    @endif
    <div class="p-4">
        {{ $abilities->links() }}
    </div>
</div>