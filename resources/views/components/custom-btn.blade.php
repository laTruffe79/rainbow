<a href="{{$href}}"
   class="px-8 text-gray-200 py-4 rounded-lg bg-gradient-to-r {{ $disabled ? 'disabled pointer-events-none to-violet-900' : 'to-fuchsia-600 pointer-events-auto' }}
   from-violet-900  font-bold">
    @if($icon !== '')
		@svg($icon,'h-4 w-4 fill-current fill')
    @endif
    {{$text}}
</a>
