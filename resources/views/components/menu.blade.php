<div class="relative">
    <nav x-data="{showMenu:false}"
         class="">
        <div
            x-on:click="showMenu=!showMenu;$dispatch('click-menu')"
            class="text-fuchsia-500 h-6 w-6 float-right hover:cursor-pointer">
            @svg('icon-zondicons.menu','h-6 w-6 fill-current fill-fuchsia-500')
        </div>
        <div x-show="showMenu"
             x-on:click.outside="showMenu=false;$dispatch('click-menu')"
             x-cloak
             class="absolute bottom-8 right-0 text-fuchsia-500 blue-tile-app border border-gray-200 rounded-lg
        px-8 py-4 float-right z-50 space-y-1.5">
            @foreach($menuItems as $route => $menuItem)
                <a class="block text-xl hover:text-fuchsia-300" href="{{route($route)}}">{{$menuItem}}</a>
            @endforeach
        </div>

    </nav>
</div>

