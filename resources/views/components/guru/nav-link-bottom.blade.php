@props([
    'active' => false,
    'label' => '',
])
<a wire:navigate {{ $attributes }}
    class="flex flex-col p-2 rounded-lg items-center text-white {{ $active ? 'bg-blue-500' : 'bg-blue-500' }}">
    {{ $slot }}
    <span class=" {{ $active ? 'block' : 'hidden' }} text-xs capitalize">{{ $label }}</span>

</a>
