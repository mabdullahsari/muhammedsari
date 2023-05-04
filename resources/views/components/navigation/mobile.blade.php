@props(['path' => null, 'label' => null])

<li>
    <a href="{{ $path }}" class="px-3 py-1 whitespace-nowrap block hover:bg-zinc-600 rounded-lg hover:text-white transition-colors">{{ $label }}</a>
</li>
