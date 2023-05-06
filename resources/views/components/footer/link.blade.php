@props(['label' => null, 'url' => null])

<a href="{{ $url }}"
   title="{{ $label }}"
   aria-label="{{ $label }}"
   target="_blank" rel="noopener noreferrer"
   {{ $attributes->class('ml-4 rounded-xl transition-colors outline-offset-8 outline-2 focus:outline') }}
>
    <x-icon :name="strtolower($label)" class="w-5 h-5" />
</a>
