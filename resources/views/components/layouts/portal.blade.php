<div 
    class="flex w-full h-screen overflow-hidden bg-gray-100"
    x-data="PortalSidebar"
    x-init="init()"
    x-on:resize.window="resizeHandler"
>
    <aside 
        class="fixed z-10 h-full overflow-hidden duration-300 ease-in-out bg-white transition-width whitespace-nowrap"
        x-bind:class="open ? 'w-64' : 'w-0'"
    >
        
        <div>
            <a href="#" class="transition-all duration-300 ease-in-out select-none focus:outline-none focus:drop-shadow-2xl">
                <x-application-logo class="min-w-[256px]" />
            </a>
        </div>

        <nav class="h-[calc(100%-216px)] p-4 overflow-y-auto overflow-x-hidden space-y-1">
            <a 
                href="#" 
                @class([
                    'select-none flex items-center gap-2 p-2 text-lg font-medium text-gray-700 transition-colors duration-300 ease-in-out rounded outline-none focus:bg-gray-100 hover:bg-gray-100',
                    'bg-orange-500 text-white hover:bg-orange-400 focus:bg-orange-400' => $isActive('dashboard'),
                ])
            >
                <x-icons.dashboard />
                <span>Dashboard</span>
            </a>
            
            <a 
                href="#" 
                @class([
                    'select-none flex items-center gap-2 p-2 text-lg font-medium text-gray-700 transition-colors duration-300 ease-in-out rounded outline-none focus:bg-gray-100 hover:bg-gray-100',
                    'bg-orange-500 text-white hover:bg-orange-400 focus:bg-orange-400' => $isActive('players'),
                ])
            >
                <x-icons.person />
                <span>Players</span>
            </a>

            <a 
                href="#" 
                @class([
                    'select-none flex items-center gap-2 p-2 text-lg font-medium text-gray-700 transition-colors duration-300 ease-in-out rounded outline-none focus:bg-gray-100 hover:bg-gray-100',
                    'bg-orange-500 text-white hover:bg-orange-400 focus:bg-orange-400' => $isActive('events'),
                ])
            >
                <x-icons.event />
                <span>Events</span>
            </a>

            <a 
                href="#" 
                @class([
                    'select-none flex items-center gap-2 p-2 text-lg font-medium text-gray-700 transition-colors duration-300 ease-in-out rounded outline-none focus:bg-gray-100 hover:bg-gray-100',
                    'bg-orange-500 text-white hover:bg-orange-400 focus:bg-orange-400' => $isActive('items'),
                ])
            >
                <x-icons.swords />
                <span>Items</span>
            </a>

            <a 
                href="#" 
                @class([
                    'select-none flex items-center gap-2 p-2 text-lg font-medium text-gray-700 transition-colors duration-300 ease-in-out rounded outline-none focus:bg-gray-100 hover:bg-gray-100',
                    'bg-orange-500 text-white hover:bg-orange-400 focus:bg-orange-400' => $isActive('abilities'),
                ])
            >
                <x-icons.sprint />
                <span>Abilities</span>
            </a>
        </nav>

        <div class="h-[72px] flex items-center justify-between border-t border-gray-200 p-4">
            <div class="flex items-center w-full h-full gap-2 select-none">
                <div class="min-w-[39px] h-full overflow-hidden rounded-full aspect-square">
                    <img src="{{ Vite::asset('resources/images/default-profile-photo.svg') }}" alt="Profile Photo" class="min-w-full">
                </div>
                <p class="font-medium text-gray-700">Raymark Peña</p>
            </div>

            <x-button title="Log Out">
                <x-icons.logout  />
            </x-button>
        </div>
    </aside>

    <div 
        class="flex flex-col w-full transition-all duration-300 ease-in-out"
        x-bind:class="open ? 'lg:ml-64' : ''"
    >
        <header class="flex items-center justify-between p-4 bg-white">
            <x-subheading>{{ $pageName }}</x-subheading>

            <div class="flex items-center gap-2">      
                <x-button title="Notifications">
                    <x-icons.notifications />
                </x-button>

                <x-button title="Messages">
                    <x-icons.mail />
                </x-button>

                <x-button title="Toggle sidebar" x-on:click="toggle(!open)">
                    <x-icons.menu x-show="!open" x-cloak />
                    <x-icons.close x-show="open" x-cloak />
                </x-button>
            </div>
        </header>

        <main class="w-full h-[calc(100%-72px)] p-8 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</div>