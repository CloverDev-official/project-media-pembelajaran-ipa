@props(['active' => false])

<a wire:navigate {{ $attributes }}
    class="pl-3 py-3 rounded-lg relative
    {{ $active ? 'bg-main-dark' : 'bg-hover-dark' }}">
    {{ $slot }}
</a>

