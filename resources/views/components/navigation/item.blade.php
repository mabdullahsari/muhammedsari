@props(['active' => false, 'path' => null, 'label' => null])

<li><a href="{{ $path }}" class="{{ $active ? 'text-amber-500' : 'hover:text-zinc-200 transition-colors' }}">{{ $label }}</a></li>
