@props(['active' => false])

<a wire:navigate {{ $attributes }}
    class="relative font-semibold text-hover-dark
   after:content-[''] after:absolute after:bottom-0
   after:h-[2px] after:bg-slate-800
   after:transition-all after:duration-300
   hover:after:left-0 hover:after:w-full
   focus:outline-none capitalize
   {{ $active ? 'after:left-0 after:right-0 after:w-auto text-green-300' : 'after:left-1/2 after:w-0' }}">
    {{ $slot }}
</a>
