<a href="{{ route('tag', $slug) }}" {{ $attributes->class('group rounded-lg outline-offset-8 outline-amber-500 outline-2 focus:outline') }}>
    <span class="text-zinc-500">#</span>
    <span class="hover:text-amber-500 transition-colors group-focus:text-amber-500">{{ $name }}</span>
</a>
