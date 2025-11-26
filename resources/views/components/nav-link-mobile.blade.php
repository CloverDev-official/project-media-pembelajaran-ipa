@props(['active' => false])

<li>
    <a wire:navigate {{ $attributes }}
        class=" flex items-center gap-2 relative transition-all duration-150 hover:text-white font-bold hover:bg-blue-400 py-2 px-4 rounded-full
       {{ $active ? 'after:left-0 after:right-0 after:w-auto text-white font-bold bg-blue-600 py-2 px-4 rounded-full' : 'after:left-1/2 after:w-0' }}">
        {{ $slot }}
    </a>
</li>