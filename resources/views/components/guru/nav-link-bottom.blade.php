@props([
    'active' => false,
    'label' => '',
])
<a wire:navigate {{ $attributes }}
    class="flex flex-col p-2 rounded-lg items-center text-white {{ $active ? 'bg-main-dark' : 'bg-hover-dark' }}">
    {{ $slot }}
    <span class=" {{ $active ? 'block' : 'hidden' }} text-xs capitalize">{{ $label }}</span>

</a>
