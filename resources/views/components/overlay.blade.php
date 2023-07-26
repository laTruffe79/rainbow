{{-- Overlay --}}
<div
    x-data="{showOverlay:false}"
    x-show="showOverlay"
    x-cloak
    @click-menu.window="showOverlay = !showOverlay"
    class="absolute inset-0 justify-center overflow-hidden items-center fixed flex z-10 h-screen w-full blue-bg-app opacity-75">
</div>
