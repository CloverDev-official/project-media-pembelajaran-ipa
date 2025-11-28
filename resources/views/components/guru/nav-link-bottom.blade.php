@props([
    'active' => false,
    'label' => '',
])
<a wire:navigate {{ $attributes }}
    class="flex flex-col p-1 w-20 rounded-lg items-center  text-white  {{ $active ? 'bg-blue-400' : 'bg-blue-500 hover:py-3 hover:bg-blue-400' }}">
    {{ $slot }}
    <span class=" {{ $active ? 'block' : 'hidden' }} text-xs text-center capitalize">{{ $label }}</span>

</a>
