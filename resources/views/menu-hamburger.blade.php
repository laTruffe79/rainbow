<nav x-data="{showMenu:false}"
    class="">
    <div
        x-on:click="showMenu=!showMenu"
        class="text-fuchsia-500 h-6 w-6 float-right hover:cursor-pointer">
        @svg('icon-zondicons.menu','h-6 w-6 fill-current fill-fuchsia-500')
    </div>
    <div x-show="showMenu"
         x-on:click.outside="showMenu=false"
         x-cloak
        class="absolute top-4 right-0 text-fuchsia-500 blue-tile-app border border-gray-200 rounded-lg
        px-4 py-4 float-right z-50 space-y-1.5">
        <a class="block text-xl hover:text-fuchsia-300" href="#">Menu item 1</a>
        <a class="block text-xl hover:text-fuchsia-300" href="#">Menu item 2</a>
        <a class="block text-xl hover:text-fuchsia-300" href="#">Menu item 3</a>
        <a class="block text-xl hover:text-fuchsia-300" href="#">Menu item 4</a>
    </div>

    {{-- Overlay --}}
    <div x-show="showMenu"
        x-cloak
        class="absolute top-0 left-0 fixed z-10 h-screen w-screen blue-bg-app opacity-75">
    </div>

</nav>
