<div x-data="{toggle:@entangle('open')}"
     class="pl-2 flex leading-7 font-semibold text-right">
    <div class="px-2 w-20">
        <span class="text-sm  text-gray-200 dark:text-gray-200 font-bold leading-7" x-text="toggle ? 'Ouverte' : 'Fermée'">

        </span>
    </div>
    <div class="text-right w-auto">
        <label for="default-toggle-{{$session->id}}" class="inline-flex relative items-center cursor-pointer">
            <input type="checkbox"
                   x-on:change="toggle=!toggle;$dispatch('enable-disable-{{$session->id}}',{'toggle':toggle})"
                   x-bind:checked="toggle"

                   id="default-toggle-{{$session->id}}"
                   class="sr-only peer">
            <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-fuchsia-500 dark:peer-focus:ring-fuchsia-800 rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-fuchsia-500"></div>
        </label>
    </div>

</div>
