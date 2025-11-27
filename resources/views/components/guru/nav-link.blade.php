@props(['active' => false])

<a wire:navigate {{ $attributes }}
    class="pl-3 py-3 rounded-2xl relative
    {{ $active ? 'bg-blue-400' : 'hover:bg-blue-400' }}">
    {{ $slot }}
</a>
