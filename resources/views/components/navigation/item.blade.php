@props(['active' => false, 'path' => null, 'label' => null])

<li><a href="{{ $path }}" @class([
    'rounded-lg transition-colors outline-offset-8 outline-2 focus:outline',
    'outline-amber-500 text-amber-500' => $active,
    'outline-white focus:text-zinc-200 hover:text-zinc-200' => ! $active,
])>{{ $label }}</a></li>
