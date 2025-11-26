@props(['active' => false])

<a wire:navigate {{ $attributes }}
    class="relative transition-all duration-150 hover:text-white font-bold hover:bg-blue-500 py-2 px-4 rounded-full
   {{ $active ? 'after:left-0 after:right-0 after:w-auto text-white font-bold bg-blue-500 py-2 px-4 rounded-full' : 'after:left-1/2 after:w-0' }}">
    {{ $slot }}
</a>
